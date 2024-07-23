@extends('layouts.app')

@section('title', 'Create Customer')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
<div class="container">
    <h1>Adicionar Cliente</h1>
    <form action="{{ route('customers.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label">Telefone:</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <br>
        <a href="{{ route('customers.index') }}" class="btn btn-primary"> Voltar</a>

            <button type="submit" class="btn-filter">Adicionar Cliente</button>
        </div>
    </form>
</div>
@endsection