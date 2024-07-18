<!-- resources/views/hotels/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Detalhes do Hotel</div>

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome do Hotel:</label>
                    <p>{{ $hotel->name }}</p>
                </div>

                <div class="form-group">
                    <label for="address">Endereço:</label>
                    <p>{{ $hotel->address }}</p>
                </div>

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <p>{{ $hotel->description }}</p>
                </div>

                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
