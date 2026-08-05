<x-guest-layout>

    <h2 class="auth-title">
        Welcome Back 👋
    </h2>

    <p class="auth-subtitle">
        Sign in to continue managing your events.
    </p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">

            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('email')" />

        </div>

        <!-- Password -->
        <div class="form-group">

            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" />

        </div>

        <!-- Remember -->
        <div class="remember-row">

            <input
                id="remember_me"
                type="checkbox"
                name="remember">

            <label for="remember_me">
                Remember me
            </label>

        </div>

        @if (Route::has('password.request'))

            <div class="forgot-password">

                <a href="{{ route('password.request') }}">
                    Forgot your password?
                </a>

            </div>

        @endif

        <button type="submit" class="auth-button">

            Sign In

        </button>

    </form>

</x-guest-layout>