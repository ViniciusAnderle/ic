@extends('layouts.app')
@section('title', 'Index Hotel')

@section('content')
<h1>Hotéis</h1>
<a href="{{ route('hotels.create') }}" class="btn btn-primary"> Adicionar novo hotél</a>

<ul>
    @foreach($hotels as $hotel)
        <li>
            {{ $hotel->name }} - {{ $hotel->address }}
            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-info">Detalhes</a>
            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Excluir</button>
                </form>
        </li>
    @endforeach

</ul>
@endsection
