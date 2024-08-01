<!--============================
    MAIN MENU
==============================-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-book-open"></i> La Casa del Libro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex ms-3" action="{{ route('search') }}" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.catalogo.index')}}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.nosostros.index')}}">Quienes Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">Contactos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!--============================
    MAIN MENU END
==============================-->
