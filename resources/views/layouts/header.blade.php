<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/hotels') }}">Hotels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/rooms') }}">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/customers') }}">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/reservations') }}">Reservations</a>
                </li>


                <li class="nav-item dropdown">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </li>
            </ul>

        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
</header>