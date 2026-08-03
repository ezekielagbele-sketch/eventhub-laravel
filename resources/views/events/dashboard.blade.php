@extends('layouts.app')

@section('content')

<h1>Organizer Dashboard</h1>

<div class="events-grid">

    <div class="event-card">
        <h2>{{ $totalEvents }}</h2>
        <p>Total Events</p>
    </div>

    <div class="event-card">
        <h2>{{ $totalRegistrations }}</h2>
        <p>Total Registrations</p>
    </div>

    <div class="event-card">
        <h2>{{ $remainingSeats }}</h2>
        <p>Remaining Seats</p>
    </div>

    <div class="event-card">

        <h2>

            {{ $mostPopularEvent?->title ?? 'No Events Yet' }}

        </h2>

        <p>Most Popular Event</p>

    </div>

</div>

@endsection