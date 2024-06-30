<h1>Create Hotel</h1>
<form action="{{ route('hotels.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Address:</label>
    <input type="text" name="address">
    <label>Description:</label>
    <textarea name="description"></textarea>
    <button type="submit">Create Hotel</button>
</form>
