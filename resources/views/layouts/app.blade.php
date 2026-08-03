<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>   
<body>


<nav class="navbar">

    <!-- Logo -->
    <div class="logo">
        <a href="{{ route('home') }}">EventHub</a>
    </div>

    <!-- Mobile Toggle -->
    <button class="menu-toggle" id="menuToggle">
        ☰
    </button>

    <!-- Navigation -->
    <div class="nav-menu" id="navMenu">

        <!-- Left Links -->
        <div class="nav-links">

            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active-nav' : '' }}">
                Home
            </a>

            <a href="{{ route('events.index') }}"
               class="{{ request()->routeIs('events.*') ? 'active-nav' : '' }}">
                Events
            </a>

            <a href="{{ route('home') }}#about">
                About
            </a>

            <a href="{{ route('home') }}#footer">
                Contact
            </a>

        </div>

        <!-- Right Side -->
        <div class="nav-right">

            @guest

                <a href="{{ route('login') }}" class="btn btn-secondary">
                    <i data-lucide="user"></i>
                    <span>Login</span>
                </a>

                <a href="{{ route('register') }}" class="btn">
                    <i data-lucide="user-plus"></i>
                    <span>Register</span>
                </a>

            @endguest

            @auth

                <a href="{{ route('events.create') }}" class="btn">
                    + Create Event
                </a>

                @php

                    $names = explode(' ', auth()->user()->name);

                    $initials = strtoupper(substr($names[0],0,1));

                    if(count($names)>1){
                        $initials .= strtoupper(substr($names[1],0,1));
                    }

                @endphp

                <div class="user-dropdown">

                    <button
                        class="user-btn"
                        id="userMenuBtn"
                        type="button">

                        <div class="avatar">

                            {{ $initials }}

                        </div>

                        <span>{{ auth()->user()->name }}</span>

                        ▼

                    </button>

                    <div class="dropdown-menu" id="dropdownMenu">

                        <div class="dropdown-header">

                            <div class="avatar large">

                                {{ $initials }}

                            </div>

                            <div>

                                <strong>{{ auth()->user()->name }}</strong>

                                <small>{{ auth()->user()->email }}</small>

                            </div>

                        </div>

                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>

                        <a href="{{ route('events.my') }}">
                            My Events
                        </a>

                        <a href="{{ route('registrations.my') }}">
                            My Registrations
                        </a>

                        <a href="{{ route('profile.edit') }}">
                            Profile
                        </a>

                        <form
                            action="{{ route('logout') }}"
                            method="POST">

                            @csrf

                            <button type="submit">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            @endauth

        </div>

    </div>

</nav>

<div class="container">

    <div class="toast-container">

@if(session('success'))

<div class="toast toast-success">

    <span class="toast-icon">✔</span>

    <span>{{ session('success') }}</span>

    <span class="toast-close">&times;</span>

</div>

@endif


@if(session('error'))

<div class="toast toast-error">

    <span class="toast-icon">✖</span>

    <span>{{ session('error') }}</span>

    <span class="toast-close">&times;</span>

</div>

@endif


@if(session('warning'))

<div class="toast toast-warning">

    <span class="toast-icon">⚠</span>

    <span>{{ session('warning') }}</span>

    <span class="toast-close">&times;</span>

</div>

@endif

</div>

    @if($errors->any())

        <div class="flash-message flash-error">

            <strong>Please fix the following:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>

const menuButton = document.getElementById('userMenuBtn');
const dropdown = document.getElementById('dropdownMenu');

console.log(menuButton);
console.log(dropdown);

if (menuButton && dropdown) {

    menuButton.addEventListener('click', function (e) {

        console.log("Button clicked");

        e.preventDefault();
        e.stopPropagation();

        dropdown.classList.toggle('show');

    });

}

</script>


<script src="https://unpkg.com/lucide@latest"></script>

<script>

document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll('.toast').forEach(toast=>{

        setTimeout(()=>{

            toast.style.transition='.4s';

            toast.style.opacity='0';

            toast.style.transform='translateX(100%)';

            setTimeout(()=>toast.remove(),400);

        },4500);

    });

    document.querySelectorAll('.toast-close').forEach(close=>{

        close.addEventListener('click',()=>{

            close.parentElement.remove();

        });

    });

});

</script>
<script>

const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');

if(menuToggle && navMenu){

    menuToggle.addEventListener('click', function(){

        navMenu.classList.toggle('active');

    });

}

</script>

</body>
</html>