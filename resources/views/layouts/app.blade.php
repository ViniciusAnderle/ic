<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <!-- Adicione seus estilos CSS aqui -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- Barra de navegação ou cabeçalho -->
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer>
        <!-- Rodapé -->
    </footer>

    <!-- Adicione seus scripts JavaScript aqui -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
