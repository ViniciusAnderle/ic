@extends('layouts.app')

@section('title', 'Room Details')

@section('content')
<div class="container mt-4">
    <h1>Detalhes do quarto</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Número do quarto:</strong> {{ $room->room_number }}</p>
            <p><strong>Tipo:</strong> {{ $room->type }}</p>
            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Editar</a>

            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
