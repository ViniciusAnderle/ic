<h1>List of Rooms</h1>
<a href="{{ route('rooms.create') }}">Create Room</a>
<ul>
    @foreach($rooms as $room)
        <li>
            Room Number: {{ $room->room_number }}<br>
            Type: {{ $room->type }}<br>
            Rate: {{ $room->rate }}<br>
            <a href="{{ route('rooms.show', $room->id) }}">View</a>
            <a href="{{ route('rooms.edit', $room->id) }}">Edit</a>
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
