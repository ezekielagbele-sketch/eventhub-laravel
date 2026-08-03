<section>

    <div class="profile-section-header">

        <h2>

            🔒 Update Password

        </h2>

        <p>

            Keep your account secure by using a strong password.

        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>

                Current Password

            </label>

            <input
                type="password"
                name="current_password"
                autocomplete="current-password">

            @if($errors->updatePassword->has('current_password'))

                <small class="error-text">

                    {{ $errors->updatePassword->first('current_password') }}

                </small>

            @endif

        </div>

        <div class="form-group">

            <label>

                New Password

            </label>

            <input
                type="password"
                name="password"
                autocomplete="new-password">

            @if($errors->updatePassword->has('password'))

                <small class="error-text">

                    {{ $errors->updatePassword->first('password') }}

                </small>

            @endif

        </div>

        <div class="form-group">

            <label>

                Confirm Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password">

            @if($errors->updatePassword->has('password_confirmation'))

                <small class="error-text">

                    {{ $errors->updatePassword->first('password_confirmation') }}

                </small>

            @endif

        </div>

        <button
            type="submit"
            class="btn">

            Save Password

        </button>

        @if(session('status') === 'password-updated')

            <p class="success-text">

                Password updated successfully.

            </p>

        @endif

    </form>

</section>