@extends('layouts.app')

@section('content')

<h1>Create Event</h1>

<form action="{{ route('events.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div style="margin-bottom:20px;">

        <label>Title</label><br>

        <input type="text" name="title">

    </div>

    <div class="form-group">
    <label for="category_id">Category</label>

    <select name="category_id" id="category_id" required>
        <option value="">-- Select a Category --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <small style="color:red;">{{ $message }}</small>
    @enderror
    </div>

    <div style="margin-bottom:20px;">

        <label>Description</label><br>

        <textarea rows="5" name="description"></textarea>

    </div>

    <div style="margin-bottom:20px;">

        <label>Venue</label><br>

        <input type="text" name="venue">

    </div>

    <div style="margin-bottom:20px;">

        <label>Date</label><br>

        <input type="date" name="event_date">

    </div>

    <div style="margin-bottom:20px;">

        <label>Time</label><br>

        <input type="time" name="event_time">

    </div>

    <div style="margin-bottom:20px;">

        <label>Capacity</label><br>

        <input type="number" name="capacity">

    </div>
 
    <div style="margin-bottom:20px;">

    <label>Event Flyer</label><br>

    <input
        type="file"
        name="image"
        accept="image/*">

    </div>

    <button class="btn">

        Save Event

    </button>

</form>

@endsection