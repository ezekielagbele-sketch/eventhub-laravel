@extends('layouts.app')

@section('content')

<div class="dashboard-container">

    <!-- Hero Section -->
    <section class="dashboard-hero">

        <div>

            <h1>
                Welcome back,
                {{ auth()->user()->name }}
                👋
            </h1>

            <p>
                Manage your events and monitor registrations from one place.
            </p>

        </div>

        <a href="{{ route('events.create') }}" class="dashboard-create-btn">
            + Create Event
        </a>

    </section>

    <!-- Statistics Cards -->

    <section class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">
                📅
            </div>

            <h2>{{ $eventsCreated }}</h2>

            <p>Total Events</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                ⏰
            </div>

            <h2>{{ $upcomingEvents }}</h2>

            <p>Upcoming Events</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                🎟️
            </div>

            <h2>{{ $totalRegistrations }}</h2>

            <p>Registrations</p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">
                🪑
            </div>

            <h2>{{ $remainingSeats }}</h2>

            <p>Remaining Seats</p>

        </div>

    </section>

    <!-- Notifications Section -->
    @if(count($notifications))

<section class="dashboard-notifications">

    <h2>🔔 Notifications</h2>

    @foreach($notifications as $notification)

        <div class="notification {{ $notification['type'] }}">

            {{ $notification['message'] }}

        </div>

    @endforeach

</section>

@endif

<!-- Registration Analytics -->

<section class="dashboard-chart">

    <h2>📊 Registration Analytics</h2>

    <canvas id="registrationChart"></canvas>

</section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('registrationChart');

if(ctx){

    new Chart(ctx,{

        type:'bar',

        data:{

            labels:@json($chartLabels),

            datasets:[{

                label:'Registrations',

                data:@json($chartData),

                backgroundColor:'#2563eb',

                borderRadius:8

            }]

        },

        options:{

            responsive:true,

            plugins:{

                legend:{
                    display:false
                }

            },

            scales:{

                y:{

                    beginAtZero:true,

                    ticks:{
                        precision:0
                    }

                }

            }

        }

    });

}

</script>

@endsection