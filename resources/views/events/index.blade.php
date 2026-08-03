@extends('layouts.app')

@section('content')

@include('events.banner')

@include('events.filters')

@include('events.cards')

<div class="pagination-wrapper">

    {{ $events->links('vendor.pagination.eventhub') }}

</div>

@endsection