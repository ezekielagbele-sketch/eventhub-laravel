<x-guest-layout>

    <h2 class="auth-title">
        Verify Your Email 📧
    </h2>

    <p class="auth-subtitle">
        Thanks for joining EventHub! Before you can start creating and managing events, please verify your email address by clicking the verification link we sent to your inbox.
    </p>

    @if (session('status') == 'verification-link-sent')

        <div class="success-message">

            A new verification link has been sent to your email address.

        </div>

    @endif

    <div class="verification-actions">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>

                {{ __('Resend Verification Email') }}

            </x-primary-button>

        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="secondary-link">

                {{ __('Log Out') }}

            </button>

        </form>

    </div>

</x-guest-layout>