<section class="upcoming-events">

    <div class="section-title">

        <span>UPCOMING EVENTS</span>

        <h2>Discover What's Happening Next</h2>

        <p>
            Explore workshops, conferences, networking sessions,
            concerts and community events happening around you.
        </p>

    </div>

    <div class="events-grid">

        @forelse($events as $event)

        <div class="event-card">

            <div class="event-image">

                @if($event->image)

                    <img
                        src="{{ asset('storage/'.$event->image) }}"
                        alt="{{ $event->title }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/default-event.jpg.jpeg') }}';">

                @else

                    <img
                        src="{{ asset('images/default-event.jpg.jpeg') }}"
                        alt="Default Event">

                @endif

                <span class="event-badge">

                    {{ $event->category->name ?? 'General' }}

                </span>

            </div>

            <div class="event-content">

                <h3>

                    {{ $event->title }}

                </h3>

                <p>

                    {{ Str::limit($event->description,100) }}

                </p>

                <div class="event-info">

                    <span>
                        📅
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </span>

                    <span>
                        📍 {{ $event->venue }}
                    </span>

                </div>

                <div class="event-footer">

                    <div class="capacity">

                        👥 {{ $event->capacity }} Seats

                    </div>

                    <a
                        href="{{ route('events.show',$event) }}"
                        class="btn">

                        View Event

                    </a>

                </div>

            </div>

        </div>

        @empty

            <div class="empty-events">

                <h3>No Events Available</h3>

                <p>

                    Check back soon.

                </p>

            </div>

        @endforelse

    </div>

</section>