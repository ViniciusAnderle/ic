<h1>List of Customers</h1>
<a href="{{ route('customers.create') }}">Create Customer</a>
<ul>
    @foreach($customers as $customer)
        <li>
            Name: {{ $customer->name }}<br>
            Email: {{ $customer->email }}<br>
            Phone: {{ $customer->phone }}<br>
            Reservations: {{ $customer->reservation_count }}<br>

            <a href="{{ route('customers.show', $customer->id) }}">View</a>
            <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
