@extends('layouts.app')
@section('title', 'Create Customer')

@section('content')

<h1>Create Customer</h1>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Phone:</label>
        <input type="text" name="phone" required><br>
        <button type="submit">Create Customer</button>
    </form>