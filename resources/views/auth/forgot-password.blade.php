<x-guest-layout>

    <h2 class="auth-title">
        Forgot Your Password?
    </h2>

    <p class="auth-subtitle">
        Enter your email address and we'll send you a secure password reset link.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <div class="flex items-center justify-between mt-6">

            <a
                href="{{ route('login') }}"
                class="underline text-sm text-gray-600 hover:text-indigo-600">

                ← Back to Login

            </a>

            <x-primary-button>

                {{ __('Send Reset Link') }}

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>