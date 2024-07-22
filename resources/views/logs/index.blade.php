@extends('layouts.app')
@section('title', 'Logs')

@section('content')

<div class="container mt-4">
    <h1>Logs</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Usuário</th>
                <th>Ação</th>
                <th>Descrição</th>
                <th>Data e Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->user ? $log->user->name : 'Usuário desconhecido' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
