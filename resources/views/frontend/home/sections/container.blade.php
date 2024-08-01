<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Productos en dos columnas -->
            <div class="row">
                @foreach ($productos as $producto)
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <a href="#!">
                                <img class="card-img-top" src="{{ asset($producto->imagen) }}"
                                    alt="{{ $producto->nombre }}" style="width: 100%; height: 350px;" />
                            </a>
                            <div class="card-body">
                                <div class="small text-muted">{{ $producto->created_at->format('d de F, Y') }}</div>
                                <h2 class="card-title h4">{{ $producto->nombre }}</h2>
                                <p class="card-text">{{ $producto->breve_descripcion }}</p>
                                <a class="btn btn-primary" href="#!">Leer más →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        </div>
        <!-- Widgets laterales -->
        <div class="col-lg-4">
            <!-- Widget de búsqueda -->
            <div class="card mb-4">
                <div class="card-header">Buscar</div>
                <div class="card-body">
                    
                        <form class="d-flex ms-3" action="{{ route('search') }}" method="GET">
                            <input class="form-control me-2" type="search" name="query" placeholder="Buscar"
                                aria-label="Buscar">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    
                </div>
            </div>
            <!-- Widget de categorías -->
            <div class="card mb-4">
                <div class="card-header">Categorías</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                @foreach ($categorias as $categoria)
                                    <li><a href="#!">{{ $categoria->nombre }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget lateral -->
            <div class="card mb-4">
                <div class="card-header">Widget Lateral</div>
                <div class="card-body">
                    Puedes poner cualquier cosa dentro de estos widgets laterales. Son fáciles de usar y cuentan con el
                    componente de tarjeta de Bootstrap 5.
                </div>
            </div>
        </div>
    </div>
</div>
