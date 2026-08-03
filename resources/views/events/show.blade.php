@extends('layouts.app')

@section('content')

<div class="event-details-page">

    {{-- Banner --}}

    <section class="event-hero">

        @if($event->image)

            <img
                src="{{ asset('storage/'.$event->image) }}"
                alt="{{ $event->title }}"
                class="event-banner">

        @else

            <img
                src="{{ asset('images/default-event.jpg.jpeg') }}"
                alt="Default Event"
                class="event-banner">

        @endif

        <div class="event-overlay">

            @if($event->category)

                <span class="category-badge">
                    {{ $event->category->name }}
                </span>

            @endif

            <h1>{{ $event->title }}</h1>

        </div>

    </section>


    <div class="event-layout">

        {{-- LEFT --}}

        <div class="event-main">

            <div class="info-grid">

                <div class="info-card">
                    <h4>📅 Date</h4>
                    <p>{{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }}</p>
                </div>

                <div class="info-card">
                    <h4>🕒 Time</h4>
                    <p>{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</p>
                </div>

                <div class="info-card">
                    <h4>📍 Venue</h4>
                    <p>{{ $event->venue }}</p>
                </div>

            </div>

            <div class="description-card">

                <h2>About This Event</h2>

                <p>

                    {{ $event->description }}

                </p>

            </div>

            @can('update', $event)

<div class="event-actions">

    <a href="{{ route('events.registrations',$event) }}"
       class="btn">

        View Registrations

    </a>

</div>

@endcan

        </div>


        {{-- SIDEBAR --}}

        <aside class="event-sidebar">

            @php

                $percentage = $event->capacity > 0
                ? round(($event->registrations_count/$event->capacity)*100)
                : 0;

                $remaining = $event->capacity-$event->registrations_count;

            @endphp

            <div class="register-card">

                <h3>Registration</h3>

                <div class="progress">

                    <div
                        class="progress-fill"
                        style="width:{{ $percentage }}%">

                    </div>

                </div>

                <p>

                    {{ $event->registrations_count }}

                    /

                    {{ $event->capacity }}

                    Registered

                </p>

                <p>

                    <strong>

                        {{ $remaining }}

                    </strong>

                    Seats Remaining

                </p>

                @if($remaining>0)

        <form action="{{ route('registrations.store',$event) }}" method="POST">

            @csrf

            @guest

                <div class="form-group">

                    <label>👤 Full Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        required>

                </div>

                <div class="form-group">

                    <label>📧 Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@email.com"
                        required>

                </div>

            @endguest

            @auth

                <div class="user-summary">

                    <div class="user-avatar">

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </div>

                <div>

                    <strong>{{ auth()->user()->name }}</strong>

                    <p>{{ auth()->user()->email }}</p>

                </div>

            </div>

        @endauth

        <div class="form-group">

            <label>📱 Phone Number</label>

            <input
                type="text"
               name="phone"
            value="{{ old('phone') }}"
            placeholder="+234..."
            required>

    </div>

    <button class="btn btn-success">

        🎟 Register Now

    </button>

</form>
                @else

                <div class="full-event">

                    Event Full

                </div>

                @endif

            </div>

        </aside>

    </div>

    <div class="back-link">

        <a href="{{ route('events.index') }}" class="back-btn">

            ← Back to Events

        </a>

    </div>

</div>

@endsection