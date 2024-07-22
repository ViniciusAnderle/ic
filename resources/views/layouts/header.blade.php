<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>

        <div class="collapse navbar-collapse" id="navbarNav">
        
            Usuário: {{ Auth::user()->name }} <span class="caret"></span>

        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button id="logout" type="submit" class="btn-logout">Logout</button>
        </form>
        <ul class="navbar-nav ml-auto">
                <a class="nav-link" href="{{ url('/hotels') }}">Hotels</a>
                <a class="nav-link" href="{{ url('/rooms') }}">Rooms</a>
                <a class="nav-link" href="{{ url('/customers') }}">Customers</a>
                <a class="nav-link" href="{{ url('/reservations') }}">Reservations</a>
            </ul>
    </nav>
</header>