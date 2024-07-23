@extends('layouts.app')
@section('title', 'Show Customer')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
@csrf
<h1>Dados do cliente</h1>
<p><strong>Nome:</strong> {{ $customer->name }}</p>
<p><strong>Email:</strong> {{ $customer->email }}</p>
<p><strong>Telefone:</strong> {{ $customer->phone }}</p>

<a href="{{ route('customers.index') }}" class="btn btn-secondary">Voltar</a>
<a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Editar</a>
<form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-delete">Excluir</button>
    </form>
@endsection