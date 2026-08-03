@extends('layouts.app')

@section('content')

<h1>Edit Event</h1>

<form action="{{ route('events.update', $event->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div style="margin-bottom:20px;">
        <label>Title</label><br>
        <input
            type="text"
            name="title"
            value="{{ old('title', $event->title) }}">
    </div>

    <div style="margin-bottom:20px;">
        <label>Description</label><br>
        <textarea
            name="description"
            rows="5">{{ old('description', $event->description) }}</textarea>
    </div>

    <div style="margin-bottom:20px;">
        <label>Venue</label><br>
        <input
            type="text"
            name="venue"
            value="{{ old('venue', $event->venue) }}">
    </div>

    <div style="margin-bottom:20px;">
        <label>Date</label><br>
        <input
            type="date"
            name="event_date"
            value="{{ old('event_date', $event->event_date) }}">
    </div>

    <div style="margin-bottom:20px;">
        <label>Time</label><br>
        <input
            type="time"
            name="event_time"
            value="{{ old('event_time', $event->event_time) }}">
    </div>

    <div style="margin-bottom:20px;">
        <label>Capacity</label><br>
        <input
            type="number"
            name="capacity"
            value="{{ old('capacity', $event->capacity) }}">
    </div>

    <button type="submit">
        Update Event
    </button>

</form>

@endsection