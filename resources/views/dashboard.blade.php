@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="dashboard-hero">

    <div>
        <h1>
            Welcome back, {{ auth()->user()->name }} 👋
        </h1>

        <p>
            Manage your events and monitor registrations from one place.
        </p>
    </div>

    <a href="{{ route('events.create') }}" class="dashboard-create-btn">
        + Create Event
    </a>

</section>


<!-- STATS -->
<section class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <h2>{{ $eventsCreated }}</h2>
        <p>Total Events</p>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⏰</div>
        <h2>{{ $upcomingEvents }}</h2>
        <p>Upcoming Events</p>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🎟️</div>
        <h2>{{ $totalRegistrations }}</h2>
        <p>Registrations</p>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🪑</div>
        <h2>{{ $remainingSeats }}</h2>
        <p>Remaining Seats</p>
    </div>

</section>

<section class="dashboard-section">

    <div class="section-header">

        <h2>📅 Recent Events</h2>

        <a href="{{ route('events.index') }}">View All →</a>

    </div>

    @forelse($recentEvents as $event)

        <div class="dashboard-event-row">

            <div>

                <strong>{{ $event->title }}</strong>

                <br>

                <small>

                    {{ $event->event_date->format('d M Y') }}

                </small>

            </div>

            <div>

                {{ $event->registrations_count }}

                Registrations

            </div>

        </div>

    @empty

        <p>You haven't created any events yet.</p>

    @endforelse

</section>

<!-- Quick Actions -->

<section class="dashboard-section">

    <div class="section-header">

        <h2>⚡ Quick Actions</h2>

    </div>

    <div class="quick-actions">

        <a href="{{ route('events.create') }}" class="action-card">
            <span>➕</span>
            <h3>Create Event</h3>
            <p>Create a new event for attendees.</p>
        </a>

        <a href="{{ route('events.index') }}" class="action-card">
            <span>📅</span>
            <h3>Browse Events</h3>
            <p>View all available events.</p>
        </a>

        <a href="{{ route('events.my') }}" class="action-card">
            <span>🎤</span>
            <h3>My Events</h3>
            <p>Manage events you've created.</p>
        </a>

        <a href="{{ route('registrations.my') }}" class="action-card">
            <span>🎟️</span>
            <h3>My Registrations</h3>
            <p>See events you've registered for.</p>
        </a>

    </div>

</section>

<!-- Dashboard Summary -->

<section class="dashboard-summary">

    <div class="summary-card">

        <h2>🏆 Most Popular Event</h2>

        @if($mostPopularEvent)

            <h3>{{ $mostPopularEvent->title }}</h3>

            <p>

                {{ $mostPopularEvent->registrations_count }}

                registrations

            </p>

            <small>

                {{ $mostPopularEvent->category?->name ?? 'Uncategorized' }}

            </small>

        @else

            <p>No events yet.</p>

        @endif

    </div>

    <div class="summary-card">

        <h2>📅 Next Upcoming Event</h2>

        @if($nextUpcomingEvent)

            <h3>{{ $nextUpcomingEvent->title }}</h3>

            <p>

                {{ \Carbon\Carbon::parse($nextUpcomingEvent->event_date)->format('d M Y') }}

            </p>

            <small>

                {{ $nextUpcomingEvent->venue }}

            </small>

        @else

            <p>No upcoming events.</p>

        @endif

    </div>

</section>


<!-- NOTIFICATIONS -->
@if(count($notifications))

<section class="dashboard-notifications">

    <h2>🔔 Notifications</h2>

    @foreach($notifications as $notification)

        <div class="notification {{ $notification['type'] }}">
            {{ $notification['message'] }}
        </div>

    @endforeach

</section>

@endif


<!-- ANALYTICS -->
<section class="dashboard-chart">

    <h2>📊 Registration Analytics</h2>

    <canvas id="registrationChart"></canvas>

</section>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('registrationChart');

new Chart(ctx,{
    type:'bar',
    data:{
        labels:[
            'Events',
            'Registrations',
            'Upcoming'
        ],
        datasets:[{
            label:'Overview',
            data:[
                {{ $eventsCreated }},
                {{ $totalRegistrations }},
                {{ $upcomingEvents }}
            ],
            backgroundColor:[
                '#2563eb',
                '#16a34a',
                '#f59e0b'
            ],
            borderRadius:8
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        }
    }
});

</script>

@endpush