<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="user" id="navbarNav">

            Usuário: {{ Auth::user()->name }}

        </div>
        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button id="logout" type="submit" class="btn-logout">Sair</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <a class="nav-link" href="{{ url('/') }}">Hotéis</a>
            <a class="nav-link" href="{{ url('/rooms') }}">Quartos</a>
            <a class="nav-link" href="{{ url('/customers') }}">Clientes</a>
            <a class="nav-link" href="{{ url('/reservations') }}">Reservas</a>
        </ul>
    </nav>
</header>