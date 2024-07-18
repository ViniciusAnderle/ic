<!-- Exemplo de implementação do filtro -->
<form action="{{ route('reservations.index') }}" method="GET">
    <label for="reservation_status">Filtrar por Status:</label>
    <select name="reservation_status" id="reservation_status">
        <option value="all">Todos</option>
        @foreach($reservationStatuses as $status)
            <option value="{{ $status }}">{{ $status }}</option>
        @endforeach
    </select>
    <button type="submit">Filtrar</button>
</form>

<!-- Exibição das reservas filtradas -->
<ul>
    @foreach($reservations as $reservation)
        <li>
            Hotel: {{ $reservation->hotel->name }}<br>
            Room: {{ $reservation->room->room_number }}<br>
            Customer: {{ $reservation->customer->name }}<br>
            Check-in: {{ $reservation->checkin_date }}<br>
            Check-out: {{ $reservation->checkout_date }}<br>
            Status: {{ $reservation->status }}<br>
            <a href="{{ route('reservations.show', $reservation->id) }}">View</a>
            <a href="{{ route('reservations.edit', $reservation->id) }}">Edit</a>
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
