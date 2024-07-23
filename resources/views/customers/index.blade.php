@extends('layouts.app')
@section('title', 'Index Customer')

@section('content')
<h1>Lista de clientes</h1>

<a href="{{ route('customers.create') }}" class="btn btn-primary">Adicionar Cliente</a>
<ul>
    @foreach($customers as $customer)
    <li>
        <strong>Nome:</strong> {{ $customer->name }}<br>
        <strong>Email:</strong> {{ $customer->email }}<br>
        <strong>Telefone:</strong> {{ $customer->phone }}<br>
        <strong>Número de reservas:</strong> {{ $customer->reservation_count }}<br>

        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info">Detalhes</a>
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-delete">Excluir</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection