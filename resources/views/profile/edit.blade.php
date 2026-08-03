@extends('layouts.app')

@section('content')

<div class="profile-page">

    <div class="profile-header">

        <div class="profile-avatar">

            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

        </div>

        <h1>

            Profile Settings

        </h1>

        <p>

            Manage your account information.

        </p>

    </div>

    <div class="profile-card">

        @include('profile.partials.update-profile-information-form')

    </div>

    <div class="profile-card">

        @include('profile.partials.update-password-form')

    </div>

    <div class="profile-card danger-card">

        @include('profile.partials.delete-user-form')

    </div>

</div>

@endsection