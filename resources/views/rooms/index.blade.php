@extends('layouts.app')

@section('title', 'List of Rooms')

@section('content')
<div class="container mt-4">
    <h1>List of Rooms</h1>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Create Room</a>

    <ul class="list-group">
        @foreach($rooms as $room)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Room Number:</strong> {{ $room->room_number }}<br>
                    <strong>Type:</strong> {{ $room->type }}<br>
                    <strong>Rate:</strong> {{ $room->rate }}
                </div>
                <div>
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
