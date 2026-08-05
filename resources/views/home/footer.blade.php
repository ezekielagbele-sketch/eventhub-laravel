<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<footer class="footer" id="footer">

    <div class="footer-container">

        <div class="footer-brand">

            <img src="{{ asset('images/logo-icon.jpeg') }}"
                 alt="EventHub Logo"
                 class="footer-logo">

            <p>
                EventHub helps people discover, organize and attend
                unforgettable events across Nigeria.
            </p>

            <div class="footer-socials">

                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>

                <a href="#"><i class="fa-brands fa-instagram"></i></a>

                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>

                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>

            </div>

        </div>

        <div class="footer-links">

            <h4>Quick Links</h4>

            <a href="{{ route('home') }}">Home</a>

            <a href="{{ route('events.index') }}">Events</a>

            <a href="#about">About</a>

            <a href="#footer">Contact</a>

        </div>

        <div class="footer-links">

            <h4>Resources</h4>

            <a href="#">Privacy Policy</a>

            <a href="#">Terms of Service</a>

            <a href="#">Help Center</a>

            <a href="#">FAQs</a>

        </div>

        <div class="footer-contact">

            <h4>Contact Us</h4>

            <p><i class="fa-solid fa-envelope"></i> support@eventhub.com</p>

            <p><i class="fa-solid fa-location-dot"></i> Lagos, Nigeria</p>

            <p><i class="fa-solid fa-phone"></i> +234 800 000 0000</p>

        </div>

    </div>

    <div class="footer-bottom">

    <p>

        © {{ date('Y') }} EventHub.
        Built with ❤️ using Laravel.
        All rights reserved.

    </p>

</div>

</footer>