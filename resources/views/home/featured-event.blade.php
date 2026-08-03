@if($featuredEvent)

<section class="featured-event">

    <div class="featured-wrapper">

        <div class="featured-image">

            @if($featuredEvent->image)

                <img
                    src="{{ asset('storage/'.$featuredEvent->image) }}"
                    alt="{{ $featuredEvent->title }}"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ asset('images/default-event.jpg.jpeg') }}';">

            @else

                <img
                    src="{{ asset('images/default-event.jpg.jpeg') }}"
                    alt="Featured Event">

            @endif

        </div>

        <div class="featured-content">

            <span class="featured-tag">
                ⭐ Featured Event
            </span>

            <h2>{{ $featuredEvent->title }}</h2>

            <p>
                {{ Str::limit($featuredEvent->description,220) }}
            </p>

            <div class="featured-meta">

                <div>
                    📅 {{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('d M Y') }}
                </div>

                <div>
                    🕒 {{ \Carbon\Carbon::parse($featuredEvent->event_time)->format('g:i A') }}
                </div>

                <div>
                    📍 {{ $featuredEvent->venue }}
                </div>

                <div>
                    👥 {{ $featuredEvent->capacity }} Seats
                </div>

            </div>

            <a href="{{ route('events.show',$featuredEvent) }}" class="btn">
                View Event
            </a>

        </div>

    </div>

</section>

@endif