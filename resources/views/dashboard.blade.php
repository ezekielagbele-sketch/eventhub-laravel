@extends('layouts.app')

@section('content')

<div class="dashboard-container">

    <!-- Hero Section -->
    <section class="dashboard-hero">

        <div>

            <h1>
                Welcome back,
                {{ auth()->user()->name }}
                👋
            </h1>

            <p>
                Manage your events and monitor registrations from one place.
            </p>

        </div>

        <a href="{{ route('events.create') }}" class="dashboard-create-btn">
            + Create Event
        </a>

    </section>

    <!-- Statistics Cards -->

    <section class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">
                📅
            </div>

            <h2>{{ $eventsCreated }}</h2>

            <p>Total Events</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                ⏰
            </div>

            <h2>{{ $upcomingEvents }}</h2>

            <p>Upcoming Events</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                🎟️
            </div>

            <h2>{{ $totalRegistrations }}</h2>

            <p>Registrations</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                🪑
            </div>

            <h2>{{ $remainingSeats }}</h2>

            <p>Remaining Seats</p>

        </div>

    </section>

</div>

@endsection