@extends('layouts.app')
@section('title', 'Index Customer')

@section('content')
<h1>List of Customers</h1>

<a href="{{ route('customers.create') }}" class="btn btn-primary">Create Customer</a>
<ul>
    @foreach($customers as $customer)
    <li>
        <strong>Name:</strong> {{ $customer->name }}<br>
        <strong>Email:</strong> {{ $customer->email }}<br>
        <strong>Phone:</strong> {{ $customer->phone }}<br>
        <strong>Reservations:</strong> {{ $customer->reservation_count }}<br>

        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info">View</a>
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection