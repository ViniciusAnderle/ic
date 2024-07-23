@extends('layouts.app')
@section('title', 'Create Reservation')

@section('content')

<div class="container mt-4">
    <h1>Criar reserva</h1>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="hotel_id">Select Hotel:</label>
            <select name="hotel_id" id="hotel_id" class="form-control" required>
                <option value="">Select a hotel</option>
                @foreach($hotels as $hotel)
                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="room_id">Select Room:</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">Select a room</option>
                @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer_id">Select Customer:</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="checkin_date">Check-in Date:</label>
            <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="checkout_date">Check-out Date:</label>
            <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                @foreach($statuses as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Reservation</button>
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
                            $('#room_id').append('<option value="' + value.id + '">' + value.room_number + '</option>');
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
