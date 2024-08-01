<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">larbook.shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('vendedor.dashboard') }}">Pagina Principal</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('vendedor.delivery.index') }}">Delivery</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-toggle="dropdown" aria-expanded="false">Menu</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('vendedor.layouts.index') }}">Todos los productos</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ route('vendedor.lclientes.index') }}">categorias</a></li>
                        
                    </ul>
                </li>
            </ul>
            <a href="{{ route('vendedor.carrito.index') }}" class="btn btn-outline-dark">
                Vender
            </a>
            <a href="{{ route('vendedor.pedidoweb.index') }}" class="btn btn-outline-dark">
                Pedidos web
            </a>
            <!-- Enlace a la página de pedidos -->
            <a href="{{ route('vendedor.ventas.index') }}" class="btn btn-outline-dark">
    Mis ventas
</a>





            <!-- Menú desplegable de usuario -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-toggle="dropdown">
                        <img alt="image" src="{{ asset(Auth::user()->image) }}" class="rounded-circle mr-1"
                            width="30" height="30">
                        <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        
                        <a href="{{ route('vendedor.profile') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Editar perfil
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
            this.closest('form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
