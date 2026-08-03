<section class="events-filters">

<form
    action="{{ route('events.index') }}"
    method="GET"
    class="search-box">

    <input
        type="text"
        name="search"
        placeholder="Search events..."
        value="{{ request('search') }}">

    <select name="category">

        <option value="">
            All Categories
        </option>

        @foreach($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ request('category')==$category->id?'selected':'' }}>

                {{ $category->name }}

            </option>

        @endforeach

    </select>

    <button class="btn">

        Search

    </button>

</form>

</section>