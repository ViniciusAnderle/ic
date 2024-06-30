<h1>List of Hotels</h1>
<a href="{{ route('hotels.create') }}">Create Hotel</a>
<ul>
    @foreach($hotels as $hotel)
        <li>
            {{ $hotel->name }} - {{ $hotel->address }}
            <a href="{{ route('hotels.show', $hotel->id) }}">View</a>
            <a href="{{ route('hotels.edit', $hotel->id) }}">Edit</a>
            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
