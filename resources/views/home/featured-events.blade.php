<section class="featured-events">

    <div class="section-title">

        <span>FEATURED EVENTS</span>

        <h2>Events You Shouldn't Miss</h2>

        <p>
            Hand-picked events from our community. Learn, network,
            connect and create unforgettable experiences.
        </p>

    </div>

    <div class="featured-grid">

        @forelse($events->take(3) as $event)

        <div class="featured-card">

            <div class="featured-image">

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

                <span class="featured-tag">
                    ⭐ Featured
                </span>

            </div>

            <div class="featured-content">

                <span class="category-badge">
                    {{ $event->category->name ?? 'General' }}
                </span>

                <h3>{{ $event->title }}</h3>

                <p>
                    {{ Str::limit($event->description,110) }}
                </p>

                <div class="featured-meta">

                    <span>
                        📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </span>

                    <span>
                        📍 {{ $event->venue }}
                    </span>

                </div>

                <a
                    href="{{ route('events.show',$event) }}"
                    class="btn">

                    View Event

                </a>

            </div>

        </div>

        @empty

            <p>No featured events available.</p>

        @endforelse

    </div>

</section>