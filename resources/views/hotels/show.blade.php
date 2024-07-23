@extends('layouts.app')

@section('content')
<h1>Detalhes do Hotel</h1>

<div class="container">
    <div class="card">

        <div class="card-body">
            <p> <label for="name">Nome do Hotel:</label>
                {{ $hotel->name }}
            </p>
            <p>
                <label for="address">Endereço:</label>
                {{ $hotel->address }}
            </p>
            <p>
                <label for="description">Descrição:</label>
                {{ $hotel->description }}
            </p>

            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection