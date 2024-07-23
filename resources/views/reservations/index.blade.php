@extends('layouts.app')
@section('title', 'Reservations')

@section('content')

<div class="container mt-4">
<a href="{{ route('reservations.create') }}" class="btn btn-primary">Create Reservation</a>

    <!-- Filtro de reservas -->
    <form action="{{ route('reservations.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="reservation_status">Filtrar por Status:</label>
            <select name="reservation_status" id="reservation_status" class="form-control">
                <option value="all">Todos</option>
                @foreach($reservationStatuses as $status)
                    <option value="{{ $status }}" {{ request('reservation_status') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <!-- Exibição das reservas filtradas -->
    <ul class="list-group">
        @foreach($reservations as $reservation)
            <li class="list-group-item">
                <strong>Hotel:</strong> {{ $reservation->hotel->name }}<br>
                <strong>Room:</strong> {{ $reservation->room->room_number }}<br>
                <strong>Customer:</strong> {{ $reservation->customer->name }}<br>
                <strong>Check-in:</strong> {{ $reservation->checkin_date }}<br>
                <strong>Check-out:</strong> {{ $reservation->checkout_date }}<br>
                <strong>Status:</strong> {{ ucfirst($reservation->status) }}<br>
                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                    </form>
            </li>
        @endforeach
    </ul>
</div>

@endsection
