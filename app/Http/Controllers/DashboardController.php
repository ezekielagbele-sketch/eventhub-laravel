<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    
    // Events created by the user
    $events = $user->events()
        ->with('category')
        ->withCount('registrations')
        ->latest()
        ->get();

    $recentEvents = $user->events()
        ->withCount('registrations')
        ->latest()
        ->take(5)
        ->get();

        foreach ($events as $event) {

    $event->remainingSeats =
        $event->capacity - $event->registrations_count;

    $event->percentageFull =
        $event->capacity > 0
            ? round(($event->registrations_count / $event->capacity) * 100)
            : 0;
}

$categoryLabels = [];
$categoryData = [];

foreach ($events as $event) {

    if ($event->category) {

        $name = $event->category->name;

        if (! isset($categoryData[$name])) {

            $categoryData[$name] = 0;

        }

        $categoryData[$name]++;

    }

}

$categoryLabels = array_keys($categoryData);

$categoryData = array_values($categoryData);

// Event with the highest registrations
$mostPopularEvent = $events
    ->sortByDesc('registrations_count')
    ->first();

// Closest upcoming event
$nextUpcomingEvent = $events
    ->where('event_date', '>=', now()->toDateString())
    ->sortBy('event_date')
    ->first();

    $eventsCreated = $events->count();

    $upcomingEvents = $events
        ->where('event_date', '>=', now()->toDateString())
        ->count();

    $totalRegistrations = $events->sum('registrations_count');

    $remainingSeats = $events->sum(function ($event) {
    return max($event->capacity - $event->registrations_count, 0);
});

    $categoriesUsed = $events
        ->pluck('category_id')
        ->filter()
        ->unique()
        ->count();

        $chartLabels = [];

        $chartData = [];

        foreach ($events as $event) {

            $chartLabels[] = $event->title;

            $chartData[] = $event->registrations_count;

}

/* Dashboard Notification */

$notifications = [];

foreach ($events as $event) {

    // Event is full
    if ($event->remainingSeats == 0) {

        $notifications[] = [
            'type' => 'danger',
            'message' => "{$event->title} is now FULL."
        ];
    }

    // Almost full
    elseif ($event->remainingSeats <= 5) {

        $notifications[] = [
            'type' => 'warning',
            'message' => "{$event->title} has only {$event->remainingSeats} seats left."
        ];
    }

    // Starts within 3 days
    if (
        \Carbon\Carbon::parse($event->event_date)
            ->between(now(), now()->copy()->addDays(3))
    ) {

        $notifications[] = [
            'type' => 'info',
            'message' => "{$event->title} starts soon."
        ];
    }
}

    return view('dashboard', compact(
    'events',
    'recentEvents',
    'eventsCreated',
    'upcomingEvents',
    'totalRegistrations',
    'remainingSeats',
    'categoriesUsed',
    'mostPopularEvent',
    'nextUpcomingEvent',
    'chartLabels',
    'chartData',
    'notifications',
    'categoryLabels',
    'categoryData'
));
}
}