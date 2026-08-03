<section class="hero">

    <div class="hero-overlay"></div>

    <div class="container hero-container">

        <div class="hero-left">

            <span class="hero-badge">
                🎉 Nigeria's Modern Event Platform
            </span>

            <h1>
                Discover Amazing
                <span>Events</span>
                Near You
            </h1>

            <p>

                Find conferences, workshops, concerts,
                networking events and unforgettable experiences
                across Nigeria.

            </p>

            <form action="{{ route('events.index') }}" class="hero-search">

                <input
                    type="text"
                    name="search"
                    placeholder="Search events...">

                <button type="submit">
                    Search
                </button>

            </form>

            <div class="hero-stats">

                <div>
                    <h3>6+</h3>
                    <span>Events</span>
                </div>

                <div>
                    <h3>500+</h3>
                    <span>Organizers</span>
                </div>

                <div>
                    <h3>10k+</h3>
                    <span>Attendees</span>
                </div>

            </div>

        </div>

        <div class="hero-right">

            <img
                src="{{ asset('images/hero.png.png') }}"
                alt="EventHub">

        </div>

    </div>

</section>