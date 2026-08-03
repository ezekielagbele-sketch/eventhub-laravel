<section>

    <div class="profile-section-header">

        <h2>

            👤 Profile Information

        </h2>

        <p>

            Update your personal information.

        </p>

    </div>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}">

        @csrf

    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}">

        @csrf
        @method('PATCH')

        <div class="form-group">

            <label>Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required>

            @error('name')

                <small class="error-text">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required>

            @error('email')

                <small class="error-text">

                    {{ $message }}

                </small>

            @enderror

        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="verification-box">

                <p>

                    Your email address has not been verified.

                </p>

                <button
                    form="send-verification"
                    class="btn">

                    Send Verification Email

                </button>

            </div>

            @if(session('status') === 'verification-link-sent')

                <p class="success-text">

                    Verification email sent successfully.

                </p>

            @endif

        @endif

        <button
            type="submit"
            class="btn">

            Save Changes

        </button>

        @if(session('status') === 'profile-updated')

            <p class="success-text">

                Profile updated successfully.

            </p>

        @endif

    </form>

</section>