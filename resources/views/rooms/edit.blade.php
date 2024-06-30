<h1>Edit Room</h1>
<form action="{{ route('rooms.update', $room->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Room Number:</label>
    <input type="text" name="room_number" value="{{ $room->room_number }}" required><br>
    <label>Type:</label>
    <input type="text" name="type" value="{{ $room->type }}" required><br>
    <label>Rate:</label>
    <input type="number" name="rate" value="{{ $room->rate }}" required><br>
    <button type="submit">Update Room</button>
</form>
