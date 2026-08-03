@extends('layouts.app')

@section('content')

<!-- ===========================
    Dashboard Header
=========================== -->

<div class="dashboard-header">

    <div class="dashboard-header-content">

        <div>

            <h1>

                Welcome back, {{ auth()->user()->name }} 👋

            </h1>

            <p>

                Manage your events and monitor registrations from one place.

            </p>

        </div>

        <a
            href="{{ route('events.create') }}"
            class="btn">

            + Create Event

        </a>

    </div>

</div>

<!-- ===========================
    Statistics
=========================== -->

<div class="dashboard-stats">

    <div class="stat-card">

        <div class="stat-icon">📅</div>

        <h3>Total Events</h3>

        <span>{{ $eventsCreated }}</span>

    </div>

    <div class="stat-card">

        <div class="stat-icon">⏰</div>

        <h3>Upcoming</h3>

        <span>{{ $upcomingEvents }}</span>

    </div>

    <div class="stat-card">

        <div class="stat-icon">🎟</div>

        <h3>Registrations</h3>

        <span>{{ $totalRegistrations }}</span>

    </div>

    <div class="stat-card">

        <div class="stat-icon">🏷</div>

        <h3>Categories</h3>

        <span>{{ $categoriesUsed }}</span>

    </div>

</div>

<!-- ===========================
    Summary Cards
=========================== -->

<div class="dashboard-summary">

    <div class="summary-info-card">

        <h2>🔥 Most Popular Event</h2>

        @if($mostPopularEvent)

            <h3>{{ $mostPopularEvent->title }}</h3>

            <p>{{ $mostPopularEvent->registrations_count }} Registrations</p>

        @else

            <p>No events available.</p>

        @endif

    </div>

    <div class="summary-info-card">

        <h2>📅 Next Upcoming Event</h2>

        @if($nextUpcomingEvent)

            <h3>{{ $nextUpcomingEvent->title }}</h3>

            <p>

                {{ \Carbon\Carbon::parse($nextUpcomingEvent->event_date)->format('d M Y') }}

            </p>

            <small>{{ $nextUpcomingEvent->venue }}</small>

        @else

            <p>No upcoming events.</p>

        @endif

    </div>

</div>

<!-- ===========================
    Notifications
=========================== -->

<div class="dashboard-events">

    <h2>🔔 Notifications</h2>

    @forelse($notifications as $notification)

        <div class="notification {{ $notification['type'] }}">

            {{ $notification['message'] }}

        </div>

    @empty

        <p>No new notifications.</p>

    @endforelse

</div>

<!-- ===========================
    Quick Actions
=========================== -->

<div class="dashboard-actions">

    <a
        href="{{ route('events.create') }}"
        class="btn">

        + Create Event

    </a>

    <a
        href="{{ route('events.index') }}"
        class="btn">

        Browse Events

    </a>

    <a
        href="{{ route('events.my') }}"
        class="btn">

        My Events

    </a>

</div>

<!-- ===========================
    Recent Events
=========================== -->

<div class="dashboard-events">

    <h2>Recent Events</h2>

    @forelse($events as $event)

        <div class="dashboard-event">

    <div>

        <strong>

            {{ $event->title }}

        </strong>

        <br>

        <small>

            📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}

        </small>

    </div>

    <div>

        <strong>

            {{ $event->registrations_count }}

        </strong>

        <br>

        <small>

            Registrations

        </small>

    </div>

</div>

    @empty

        <p>You haven't created any events yet.</p>

    @endforelse

</div>


<!-- ===========================
    Analytics
=========================== -->

<div class="dashboard-charts">

    <div class="chart-card">

        <h2>📊 Registrations Per Event</h2>

        <canvas id="registrationChart"></canvas>

    </div>

</div>
<!-- ===========================
    Chart JS
=========================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('registrationChart');

    if (ctx) {

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Registrations',
                    data: @json($chartData),
                    backgroundColor: [
                        '#2563eb',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#06b6d4'
                    ],
                    borderRadius: 8,
                    borderWidth: 0
                }]
            }
        });

    }

});
</script>

@endsection