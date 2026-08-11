<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Api\Upload\UploadApi;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Event::withCount('registrations');

    $categories = Category::orderBy('name')->get();

    if ($request->filled('search')) {

    $query->where(function ($q) use ($request) {

        $q->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('venue', 'like', '%' . $request->search . '%');

    });

}
    
    if ($request->filled('category')) {

        $query->where('category_id', $request->category);

   }

    $events = $query->latest()->paginate(6);

    return view('events.index', compact('events', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'venue' => 'required|max:255',
        'event_date' => 'required|date',
        'event_time' => 'required',
        'capacity' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Save the logged-in user's ID
    $validated['user_id'] = Auth::id();

    //upload image to cloudinary if provided

    if ($request->hasFile('image')) {

        $upload = new UploadApi();

            $result = $upload->upload(

            $request->file('image')->getRealPath(),
            [
                'folder' => 'eventhub/events',
            ]
        );

        // Save Cloudinary's permanent HTTPS URL
        $validated['image'] = $result['secure_url'];
    }

    Event::create($validated);

    return redirect()
        ->route('events.index')
        ->with('success', 'Event created successfully!');
}

    /**
     * Display the specified resource.
     */
   public function show(Event $event)
{
    $event->loadCount('registrations');

    return view('events.show', compact('event'));
}

public function registrations(Event $event)
{
    // Only the event owner can view registrations
    $this->authorize('update', $event);

    $registrations = $event->registrations()
                           ->latest()
                           ->paginate(10);

    return view('events.registrations', compact(
        'event',
        'registrations'
    ));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        
        return view('events.edit', compact('event'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'venue' => 'required|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $event->update($validated);

        return redirect()
                 ->route('events.index')
                 ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
{
    $this->authorize('update', $event);

    $event->delete();

    return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully!');
}

public function myEvents()
{
    /** @var \App\Models\User $user */
$user = Auth::user();

$events = $user->events()
               ->withCount('registrations')
               ->latest()
               ->paginate(6);

$totalEvents = $events->total();

$totalRegistrations = $events->sum('registrations_count');

$totalCapacity = $events->sum('capacity');

$remainingSeats = max(0, $totalCapacity - $totalRegistrations);

$fullEvents = $events->filter(function ($event) {
    return $event->registrations_count >= $event->capacity;
})->count();

    return view('events.my-events', compact(
    'events',
    'totalEvents',
    'totalRegistrations',
    'remainingSeats',
    'fullEvents'
));
}


public function exportRegistrations(Event $event)
{
    $this->authorize('update', $event);

    $filename = 'event-' . $event->id . '-registrations.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ];

    $callback = function () use ($event) {

        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Name',
            'Email',
            'Phone',
            'Registered At'
        ]);

        foreach ($event->registrations as $registration) {

            fputcsv($file, [

                $registration->name,
                $registration->email,
                $registration->phone,
                $registration->created_at->format('d M Y H:i'),

            ]);

        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
