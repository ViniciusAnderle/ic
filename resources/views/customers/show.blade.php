@extends('layouts.app')
@section('title', 'Show Customer')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
@csrf
<h1>Customer Details</h1>
<p><strong>Name:</strong> {{ $customer->name }}</p>
<p><strong>Email:</strong> {{ $customer->email }}</p>
<p><strong>Phone:</strong> {{ $customer->phone }}</p>

<a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
<a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection