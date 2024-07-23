@extends('layouts.app')
@section('title', 'Edit Reservation')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

<div class="container mt-4">
    <h1>Editar Reserva</h1>
    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="hotel_id">Selecionar Hotel:</label>
            <select name="hotel_id" id="hotel_id" class="form-control" required>
                <option value="">Selecione o hotel</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ $reservation->hotel_id == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="room_id">Selecionar um quarto:</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">Selecione um quarto</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer_id">Selecionar Cliente:</label>
            <select name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $reservation->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="checkin_date">Check-in:</label>
            <input type="date" name="checkin_date" id="checkin_date" class="form-control" value="{{ $reservation->checkin_date }}" required>
        </div>

        <div class="form-group">
            <label for="checkout_date">Check-out:</label>
            <input type="date" name="checkout_date" id="checkout_date" class="form-control" value="{{ $reservation->checkout_date }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $reservation->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-edit">Atualizar Reserva</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hotel_id').change(function() {
            var hotel_id = $(this).val();
            if (hotel_id) {
                $.ajax({
                    url: '/reservations/get-rooms/' + hotel_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#room_id').empty();
                        $('#room_id').append('<option value="">Select a room</option>');
                        $.each(data, function(key, value) {
                            $('#room_id').append('<option value="'+ value.id +'">'+ value.room_number +'</option>');
                        });
                    },
                    error: function() {
                        $('#room_id').empty();
                        $('#room_id').append('<option value="">Select a room</option>');
                    }
                });
            } else {
                $('#room_id').empty();
                $('#room_id').append('<option value="">Select a room</option>');
            }
        });
    });
</script>

@endsection
