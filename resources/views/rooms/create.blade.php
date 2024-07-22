@extends('layouts.app')
@section('title', 'Create Room')

@section('content')

<div class="container mt-4">
    <h1>Create Room</h1>
    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf
        <div class="form-group">
            <label for="hotel_id">Hotel:</label>
            <select name="hotel_id" id="hotel_id" class="form-control" required>
                <option value="">Select a hotel</option>
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="room_number">Room Number:</label>
            <input type="text" class="form-control" id="room_number" name="room_number" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <button type="submit" class="btn btn-primary">Create Room</button>
    </form>
</div>

@endsection
