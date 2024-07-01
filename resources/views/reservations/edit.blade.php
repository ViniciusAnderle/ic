<!-- resources/views/reservations/edit.blade.php -->

<h1>Edit Reservation</h1>
<form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Select Hotel:</label>
    <select name="hotel_id" id="hotel_id" required>
        <option value="">Select a hotel</option>
        @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}" {{ $reservation->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
        @endforeach
    </select><br>
    
    <label>Select Room:</label>
    <select name="room_id" id="room_id" required>
        <option value="">Select a room</option>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>{{ $room->room_number }}</option>
        @endforeach
    </select><br>
    
    <label>Select Customer:</label>
    <select name="customer_id" required>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ $reservation->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
        @endforeach
    </select><br>
    
    <label>Check-in Date:</label>
    <input type="date" name="checkin_date" value="{{ $reservation->checkin_date }}" required><br>
    
    <label>Check-out Date:</label>
    <input type="date" name="checkout_date" value="{{ $reservation->checkout_date }}" required><br>
    
    <label>Status:</label>
    <select name="status" required>
        @foreach($statuses as $status)
            <option value="{{ $status }}" {{ $reservation->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select><br>
    
    <button type="submit">Update Reservation</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hotel_id').change(function() {
            var hotel_id = $(this).val();
            if(hotel_id) {
                $.ajax({
                    url: '/reservations/get-rooms/' + hotel_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#room_id').empty(); // Limpa a lista de quartos
                        $('#room_id').append('<option value="">Select a room</option>'); // Adiciona a opção padrão
                        $.each(data, function(key, value) {
                            $('#room_id').append('<option value="'+ value.id +'">'+ value.room_number +'</option>');
                        });
                    },
                    error: function() {
                        $('#room_id').empty(); // Limpa a lista de quartos em caso de erro
                        $('#room_id').append('<option value="">Select a room</option>'); // Adiciona a opção padrão
                    }
                });
            } else {
                $('#room_id').empty(); // Limpa a lista de quartos se nenhum hotel for selecionado
                $('#room_id').append('<option value="">Select a room</option>'); // Adiciona a opção padrão
            }
        });
    });
</script>
