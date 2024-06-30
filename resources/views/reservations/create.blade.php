<h1>Create Reservation</h1>
<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <label>Select Hotel:</label>
    <select name="hotel_id" required>
        @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
        @endforeach
    </select><br>
    <label>Select Room:</label>
    <select name="room_id" required>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
        @endforeach
    </select><br>
    <label>Select Customer:</label>
    <select name="customer_id" required>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select><br>
    <label>Check-in Date:</label>
    <input type="date" name="checkin_date" required><br>
    <label>Check-out Date:</label>
    <input type="date" name="checkout_date" required><br>
    <label>Status:</label>
    <input type="text" name="status" value="pending"><br>
    <button type="submit">Create Reservation</button>
</form>
