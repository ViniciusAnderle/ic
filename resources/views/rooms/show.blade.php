@extends('layouts.app')

@section('title', 'Room Details')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
<div class="container mt-4">
    <h1>Room Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Room Number:</strong> {{ $room->room_number }}</p>
            <p><strong>Type:</strong> {{ $room->type }}</p>
            <p><strong>Rate:</strong> {{ $room->rate }}</p>
            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
