@extends('layouts.app')

@section('content')

<h1>{{ $event->title }}</h1>

<h3>Event Registrations</h3>

<p>
    Total Registrations:
    <strong>{{ $registrations->total() }}</strong>
</p>
<div style="margin-bottom:20px;">

    <a href="{{ route('events.registrations.export', $event) }}"
       class="btn">

        Export CSV

    </a>

</div>
@if($registrations->count())

<table>

    <thead>

        <tr>

            <th>Name</th>

            <th>Email</th>

            <th>Phone</th>

            <th>Registered At</th>

        </tr>

    </thead>

    <tbody>

    @foreach($registrations as $registration)

        <tr>

            <td>{{ $registration->name }}</td>

            <td>{{ $registration->email }}</td>

            <td>{{ $registration->phone }}</td>

            <td>{{ $registration->created_at->format('d M Y') }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

{{ $registrations->links() }}

@else

<p>No registrations yet.</p>

@endif

@endsection