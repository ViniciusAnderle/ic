@extends('layouts.app')

@section('title', 'List of Rooms')

@section('content')
<div class="container mt-4">
    <h1>Quartos</h1>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Adicionar novo quarto</a>

    <ul class="list-group">
        @foreach($rooms as $room)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Número do quarto:</strong> {{ $room->room_number }}<br>
                    <strong>Descrição:</strong> {{ $room->type }}<br>
                    <strong>Valor:</strong> {{ $room->price }}
                </div>
                <div>
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
