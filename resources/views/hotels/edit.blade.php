@extends('layouts.app')
@section('title', 'Edit Hotel')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Editar Hotel</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('hotels.update', $hotel->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nome do Hotel</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $hotel->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $hotel->address }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $hotel->description }}</textarea>
                            </div>

                            <button type="submit" class="btn-edit">Salvar Alterações</button>
                            <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
