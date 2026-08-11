@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Create Event</h1>

    <form
        action="{{ route('events.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div style="margin-bottom:20px;">

            <label for="title">Title</label><br>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required>
        </div>


        <div class="form-group">

            <label for="category_id">Category</label>

            <select
                name="category_id"
                id="category_id"
                required>

                <option value="">
                    -- Select a Category --
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')

                <small style="color:red;">
                    {{ $message }}
                </small>

            @enderror

        </div>


        <div style="margin-bottom:20px;">

            <label for="description">
                Description
            </label><br>

            <textarea
                rows="5"
                id="description"
                name="description"
                required>{{ old('description') }}</textarea>

        </div>


        <div style="margin-bottom:20px;">

            <label for="venue">Venue</label><br>

            <input
                type="text"
                id="venue"
                name="venue"
                value="{{ old('venue') }}"
                required>

        </div>


        <div style="margin-bottom:20px;">

            <label for="event_date">Date</label><br>

            <input
                type="date"
                id="event_date"
                name="event_date"
                value="{{ old('event_date') }}"
                required>

        </div>


        <div style="margin-bottom:20px;">

            <label for="event_time">Time</label><br>

            <input
                type="time"
                id="event_time"
                name="event_time"
                value="{{ old('event_time') }}"
                required>

        </div>


        <div style="margin-bottom:20px;">

            <label for="capacity">Capacity</label><br>

            <input
                type="number"
                id="capacity"
                name="capacity"
                value="{{ old('capacity') }}"
                min="1"
                required>

        </div>


        <div style="margin-bottom:20px;">

            <label for="image">
                Event Flyer
            </label><br>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/webp">

            @error('image')

                <small style="color:red;">
                    {{ $message }}
                </small>

            @enderror

        </div>


        <button
            type="submit"
            class="btn">

            Save Event

        </button>

    </form>

</div>

@endsection