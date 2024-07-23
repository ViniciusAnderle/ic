@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

<div class="container mt-4">
    <h1>Editar quarto</h1>

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" id="hotel_id" class="form-control" required>
                @foreach($hotels as $hotel)
                <option value="{{ $hotel->id }}" {{ $hotel->id == $room->hotel_id ? 'selected' : '' }}>
                    {{ $hotel->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="room_number">número do quarto</label>
            <input type="number" name="room_number" id="room_number" class="form-control" value="{{ $room->room_number }}" required>
        </div>

        <div class="form-group">
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $room->type }}">
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $room->price }}">
        </div>

        <button type="submit" class="btn-edit">Atualizar</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection