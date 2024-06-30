<!-- Exemplo de formulário atualizado para criação de quartos -->
<form method="POST" action="{{ route('rooms.store') }}">
    @csrf
    <div class="form-group">
        <label for="hotel_id">Hotel:</label>
        <select name="hotel_id" id="hotel_id" class="form-control">
            @foreach ($hotels as $hotel)
                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="room_number">Número do Quarto:</label>
        <input type="text" class="form-control" id="room_number" name="room_number" required>
    </div>
    <div class="form-group">
        <label for="type">Tipo:</label>
        <input type="text" class="form-control" id="type" name="type">
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>
    <button type="submit" class="btn btn-primary">Criar Quarto</button>
</form>
