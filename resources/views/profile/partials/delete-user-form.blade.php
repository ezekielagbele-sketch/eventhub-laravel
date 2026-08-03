<section>

    <div class="profile-section-header">

        <h2 style="color:#dc2626;">

            ⚠ Danger Zone

        </h2>

        <p>

            Deleting your account is permanent and cannot be undone.

        </p>

    </div>

    <div class="danger-warning">

        <strong>Warning:</strong>

        Once your account is deleted, all your events, registrations and account information will be permanently removed.

    </div>

    <form
        method="POST"
        action="{{ route('profile.destroy') }}">

        @csrf
        @method('DELETE')

        <div class="form-group">

            <label>

                Confirm your password

            </label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password">

            @if($errors->userDeletion->has('password'))

                <small class="error-text">

                    {{ $errors->userDeletion->first('password') }}

                </small>

            @endif

        </div>

        <button
            type="submit"
            class="danger-btn"

            onclick="return confirm('Are you sure you want to permanently delete your account?')">

            Delete My Account

        </button>

    </form>

</section>