<table>
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
                <td>{{ $log->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
