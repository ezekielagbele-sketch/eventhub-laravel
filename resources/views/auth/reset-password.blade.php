<x-guest-layout>

    <h2 class="auth-title">
        Reset Your Password
    </h2>

    <p class="auth-subtitle">
        Create a new secure password for your EventHub account.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <x-input-label
                for="email"
                :value="__('Email Address')" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                autocomplete="username" />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-input-label
                for="password"
                :value="__('New Password')" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <!-- Confirm Password -->
        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                :value="__('Confirm New Password')" />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2" />

        </div>

        <div class="flex items-center justify-between mt-6">

            <a
                href="{{ route('login') }}"
                class="underline text-sm text-gray-600 hover:text-indigo-600">

                ← Back to Login

            </a>

            <x-primary-button>

                {{ __('Reset Password') }}

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>