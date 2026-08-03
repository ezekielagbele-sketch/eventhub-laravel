<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
{
    if (Auth::check()) {

        $validated = $request->validate([
            'phone' => 'required|max:20',
        ]);

        $validated['name'] = Auth::user()->name;
        $validated['email'] = Auth::user()->email;

    } else {

        $validated = $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:20',
        ]);

    }

    if ($event->registrations()->count() >= $event->capacity) {

        return back()->with(
            'error',
            'Sorry, this event is already full.'
        );
    }

    if (Auth::check()) {

    if (
        $event->registrations()
              ->where('user_id', Auth::id())
              ->exists()
    ) {
        return back()->with(
            'error',
            'You have already registered for this event.'
        );
    }

} else {

    if (
        $event->registrations()
              ->where('email', $validated['email'])
              ->exists()
    ) {
        return back()->with(
            'error',
            'This email has already been registered for this event.'
        );
    }

}

    if (Auth::check()){
        $validated['user_id'] = Auth::id();
    }

    $event->registrations()->create($validated);

    return redirect()
        ->route('events.show', $event)
        ->with('success', '🎉 Registration completed successfully!');
}

public function myRegistrations()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $registrations = $user
        ->registrations()
        ->with('event.category')
        ->latest()
        ->paginate(6);

    return view('registrations.my', compact('registrations'));
}
}