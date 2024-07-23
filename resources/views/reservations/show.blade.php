@extends('layouts.app')
@section('title', 'Reservation Details')

@section('content')

<div class="container mt-4">
    <h1>Detalhes da reserva</h1>
    <div class="card">

        <div class="card-body">
            <p><strong>Hotel:</strong> {{ $reservation->hotel->name }}</p>
            <p><strong>Room:</strong> {{ $reservation->room->room_number }}</p>
            <p><strong>Customer:</strong> {{ $reservation->customer->name }}</p>
            <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reservation->checkin_date)->format('d/m/Y') }}</p>
            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reservation->checkout_date)->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

@endsection