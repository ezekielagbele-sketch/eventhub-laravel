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

            <!-- Event Image -->
<div class="event-image">

    @if($event->image)

        <img
            src="{{ filter_var($event->image, FILTER_VALIDATE_URL)
                ? $event->image
                : asset('storage/' . $event->image) }}"
            alt="{{ $event->title }}"
            loading="lazy">

    @else

        <img
            src="{{ asset('images/default-event.jpg.jpeg') }}"
            alt="Default Event"
            loading="lazy">

    @endif

</div>


            <!-- Event Details -->
            <div class="event-details">

                <span class="category-badge">
                    {{ $event->category->name ?? 'General' }}
                </span>

                <h3>
                    {{ $event->title }}
                </h3>

                <p>
                    {{ Str::limit($event->description, 120) }}
                </p>

                <div class="event-meta">

                    <span>
                        📍 {{ $event->venue }}
                    </span>

                    <span>
                        📅
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </span>

                </div>

            </div>


            <!-- Event Action -->
            <div class="event-action">

                <span class="price">
                    FREE
                </span>

                <a
                    href="{{ route('events.show', $event) }}"
                    class="btn">

                    View Event

                </a>

            </div>

        </div>

    @empty

        <div class="empty-events">

            <h3>No Events Yet</h3>

            <p>
                Check back soon for exciting events.
            </p>

        </div>

    @endforelse

</div>

</section>