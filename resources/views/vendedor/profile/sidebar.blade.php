<!-- Encabezado -->
<header class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">La Casa del Libro</h1>
                <p class="lead fw-normal text-white-50 mb-0">Descubre nuestra amplia colección de libros, categorías y autores. Encuentra lo que necesitas de manera rápida y sencilla.</p>
                <a class="btn btn-primary" href="{{ route('vendedor.dashboard') }}">Ir al Dashboard</a>
                
                <!-- Formulario de búsqueda -->
                <form class="mt-4" action="{{ route('vendedor.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Buscar productos, categorías o clientes" required>
                        <button class="btn btn-secondary" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Resultados de búsqueda -->
@if(isset($query))
<section class="container mt-5">
    <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

    <!-- Productos -->
    <h3>Productos</h3>
    @if($productos->isNotEmpty())
        <ul class="list-group">
            @foreach($productos as $producto)
                <li class="list-group-item">
                    {{ $producto->nombre }} - {{ $producto->precio }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron productos.</p>
    @endif

    <!-- Categorías -->
    <h3>Categorías</h3>
    @if($categorias->isNotEmpty())
        <ul class="list-group">
            @foreach($categorias as $categoria)
                <li class="list-group-item">
                    {{ $categoria->nombre }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron categorías.</p>
    @endif

    <!-- Clientes -->
    <h3>Clientes</h3>
    @if($clientes->isNotEmpty())
        <ul class="list-group">
            @foreach($clientes as $cliente)
                <li class="list-group-item">
                    {{ $cliente->nombre }} - {{ $cliente->correo }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron clientes.</p>
    @endif
</section>
@endif
