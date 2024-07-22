@extends('layouts.app')
@section('title', 'Create Hotel')

@section('content')
<h1>Create Hotel</h1>

<form action="{{ route('hotels.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Address:</label>
        <input type="text" name="address" class="form-control">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Hotel</button>
</form>
@endsection
