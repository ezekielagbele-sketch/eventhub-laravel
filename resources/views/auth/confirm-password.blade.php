<x-guest-layout>

    <h2 class="auth-title">
        Confirm Your Password 🔒
    </h2>

    <p class="auth-subtitle">
        This is a secure area of EventHub. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>

            <x-input-label
                for="password"
                :value="__('Password')" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <div class="mt-6">

            <x-primary-button class="w-full">

                {{ __('Confirm Password') }}

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>