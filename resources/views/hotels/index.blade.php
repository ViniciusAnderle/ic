@extends('layouts.app')
@section('title', 'Index Hotel')

@section('content')
<h1>List of Hotels</h1>



<a href="{{ route('hotels.create') }}" class="btn btn-primary">Create Hotel</a>
<ul>
    @foreach($hotels as $hotel)
        <li>
            {{ $hotel->name }} - {{ $hotel->address }}
            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-info">View</a>
            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete</button>
                </form>
        </li>
    @endforeach
</ul>
@endsection
