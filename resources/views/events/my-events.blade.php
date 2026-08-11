@extends('layouts.app')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>My Events</h1>

        <p>

            Manage all the events you've created in one place.

        </p>

    </div>

    <a href="{{ route('events.create') }}" class="btn">

        + Create Event

    </a>

</div>

<div class="dashboard-stats">

    <div class="stat-card">

        <div class="stat-icon">📅</div>

        <h3>{{ $totalEvents }}</h3>

        <p>Total Events</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">👥</div>

        <h3>{{ $totalRegistrations }}</h3>

        <p>Registrations</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">💺</div>

        <h3>{{ $remainingSeats }}</h3>

        <p>Seats Left</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">✅</div>

        <h3>{{ $fullEvents }}</h3>

        <p>Full Events</p>

    </div>

</div>

<form action="{{ route('events.my') }}"
      method="GET"
      class="search-box">

    <input
        type="text"
        name="search"
        placeholder="🔍 Search events..."
        value="{{ request('search') }}">

    <button class="btn">

        Search

    </button>

</form>

<div class="events-grid">

@forelse($events as $event)

<div class="event-card">

    {{-- Event Image --}}
<div class="event-image-wrapper">

    @if($event->image)

        @if(filter_var($event->image, FILTER_VALIDATE_URL))

            {{-- Cloudinary image --}}
            <img
                src="{{ $event->image }}"
                alt="{{ $event->title }}"
                class="event-image"
                loading="lazy">

        @else

            {{-- Older local-storage image --}}
            <img
                src="{{ asset('storage/' . $event->image) }}"
                alt="{{ $event->title }}"
                class="event-image"
                loading="lazy">

        @endif

    @else

        {{-- Default image only when no image exists --}}
        <img
            src="{{ asset('images/default-event.jpg.jpeg') }}"
            alt="Default Event"
            class="event-image"
            loading="lazy">

    @endif

        {{-- Status Badge --}}
        @php
            $percentage = $event->capacity > 0
                ? ($event->registrations_count / $event->capacity) * 100
                : 0;
        @endphp

        @if($event->registrations_count >= $event->capacity)

            <span class="status-badge full">
                Full
            </span>

        @elseif($percentage >= 80)

            <span class="status-badge almost">
                Almost Full
            </span>

        @else

            <span class="status-badge active">
                Active
            </span>

        @endif

    </div>

    {{-- Card Content --}}
    <div class="event-content">

        <h2>{{ $event->title }}</h2>

        <div class="event-meta">

    <div class="meta-item">

        <span>📍</span>

        <span>{{ $event->venue }}</span>

    </div>

    <div class="meta-item">

        <span>👥</span>

        <span>{{ $event->capacity }} Seats</span>

    </div>

    <div class="meta-item">

        <span>📅</span>

        <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>

    </div>

    <div class="meta-item">

        <span>🕒</span>

        <span>{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>

    </div>

</div>

        {{-- Registration Progress --}}
        <div class="progress-bar">

            <div
                class="progress-fill"
                style="width: {{ $percentage }}%;">

            </div>

        </div>

        <div class="registration-status">

    <span>

        {{ $event->registrations_count }}

        /

        {{ $event->capacity }}

        Registered

    </span>

    <span>

        {{ round($percentage) }}%

    </span>

</div>

        {{-- Buttons --}}
        <div class="card-buttons">

            <a
                href="{{ route('events.show',$event) }}"
                class="btn btn-view">

                👁 View

            </a>

            @can('update',$event)

                <a
                    href="{{ route('events.edit',$event) }}"
                    class="btn btn-edit">

                    ✏ Edit

                </a>

                <form
                    action="{{ route('events.destroy',$event) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-delete"
                        onclick="return confirm('Delete this event?')">

                        🗑 Delete

                    </button>

                </form>

            @endcan

        </div>

    </div>

</div>

@empty

<div class="empty-state">

    <h2>No Events Found</h2>

    <p>You haven't created any events yet.</p>

    <a href="{{ route('events.create') }}" class="btn">

        Create Your First Event

    </a>

</div>

@endforelse

</div> {{-- End events-grid --}}

<div class="pagination-wrapper">
    {{ $events->links('vendor.pagination.eventhub') }}
</div>

@endsection