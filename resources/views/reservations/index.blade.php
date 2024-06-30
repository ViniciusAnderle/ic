<h1>List of Reservations</h1>
<a href="{{ route('reservations.create') }}">Create Reservation</a>
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
