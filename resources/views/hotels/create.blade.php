@extends('layouts.app')
@section('title', 'Create Hotel')

@section('content')
<h1>Criar Hotel</h1>

<form action="{{ route('hotels.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Endereço:</label>
        <input type="text" name="address" class="form-control">
    </div>
    <div class="form-group">
        <label>Descrição:</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <a href="{{ route('hotels.index') }}" class="btn btn-primary"> Voltar</a>

    <button type="submit" class="btn-filter">Adicionar hotel</button>
</form>

@endsection
