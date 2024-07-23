@extends('layouts.app')
@section('title', 'Edit Customer')

@section('content')

<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Cliente</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $customer->name) }}" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customer->email) }}" required>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $customer->phone) }}">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a href="{{ route('customers.index') }}"> Voltar</a>

                            <button type="submit" class="btn-edit">
                                Atualizar cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection