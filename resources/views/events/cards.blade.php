<div class="events-grid">

@forelse($events as $event)

<div class="event-card">

    <div class="event-image-wrapper">

        @if($event->image)

            <img
                src="{{ asset('storage/'.$event->image) }}"
                alt="{{ $event->title }}"
                class="event-image"
                loading="lazy"
                onerror="this.onerror=null;this.src='{{ asset('images/default-event.jpg.jpeg') }}';">

        @else

            <img
                src="{{ asset('images/default-event.jpg.jpeg') }}"
                alt="Default Event"
                class="event-image">

        @endif

        @if($event->category)

            <span class="category-badge">

                {{ strtoupper($event->category->name) }}

            </span>

        @endif

        <span class="date-badge">

            {{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}

        </span>

    </div>

    <div class="event-content">

        <h2>{{ $event->title }}</h2>

        <p class="event-description">

            {{ Str::limit($event->description,100) }}

        </p>

        <div class="event-meta">

            <span>📍 {{ $event->venue }}</span>

            <span>

                👥

                {{ $event->registrations_count }}

                /

                {{ $event->capacity }}

            </span>

        </div>

        <div class="event-progress">

            <div class="progress">

                <div

                    class="progress-fill"

                    style="width:{{ ($event->registrations_count / max($event->capacity,1))*100 }}%;">

                </div>

            </div>

        </div>

        <div class="card-buttons">

            <a
                href="{{ route('events.show',$event) }}"
                class="btn view-btn">

                View Event

            </a>

            @can('update',$event)

                <a
                    href="{{ route('events.edit',$event) }}"
                    class="btn edit-btn">

                    Edit

                </a>

            @endcan

        </div>

    </div>

</div>

@empty

<div class="empty-events">

    <h2>No Events Found</h2>

    <p>Try another search or create your first event.</p>

    <a
        href="{{ route('events.create') }}"
        class="btn">

        Create Event

    </a>

</div>

@endforelse

</div>