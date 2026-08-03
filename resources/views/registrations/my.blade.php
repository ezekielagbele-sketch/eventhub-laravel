@extends('layouts.app')

@section('content')

<section class="my-registrations">

    <div class="page-header">

        <span class="page-tag">
            My Account
        </span>

        <h1>My Registrations</h1>

        <p>
            Here are all the events you've successfully registered for.
        </p>

    </div>

    @if($registrations->count())

        <div class="registration-grid">

            @foreach($registrations as $registration)

                <div class="registration-card">

                    <img
                        src="{{ $registration->event->image
                            ? asset('storage/'.$registration->event->image)
                            : asset('images/default-event.jpg.jpeg') }}"
                        class="registration-image"
                        alt="{{ $registration->event->title }}">

                    <div class="registration-content">

                        @if($registration->event->category)

                            <span class="category-badge">

                                {{ $registration->event->category->name }}

                            </span>

                        @endif

                        <h3>

                            {{ $registration->event->title }}

                        </h3>

                        <div class="registration-meta">

                            <span>
                                📅
                                {{ \Carbon\Carbon::parse($registration->event->event_date)->format('d M Y') }}
                            </span>

                            <span>
                                🕒
                                {{ \Carbon\Carbon::parse($registration->event->event_time)->format('g:i A') }}
                            </span>

                        </div>

                        <div class="registration-meta">

                            <span>

                                📍 {{ $registration->event->venue }}

                            </span>

                            <span class="status">

                                ✅ Registered

                            </span>

                        </div>

                        <small class="registered-date">

                            Registered on
                            {{ $registration->created_at->format('d M Y') }}

                        </small>

                        <a
                            href="{{ route('events.show',$registration->event) }}"
                            class="btn">

                            View Event

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="pagination-wrapper">

            {{ $registrations->links('vendor.pagination.eventhub') }}

        </div>

    @else

        <div class="empty-registration">

            <h2>

                🎉 No Registrations Yet

            </h2>

            <p>

                You haven't registered for any event yet.

            </p>

            <a
                href="{{ route('events.index') }}"
                class="btn btn-secondary">

                Browse Events

            </a>

        </div>

    @endif

</section>

@endsection