@extends('vendedor.layouts.master')

@section('content')
<!-- Encabezado de Búsqueda -->
<header class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Resultados de Búsqueda</h1>
                <p class="lead fw-normal text-white-50 mb-0">Resultados para: "{{ $query }}"</p>
            </div>
        </div>
    </div>
</header>

<!-- Resultados de búsqueda -->
<section class="container mt-5">
    <h2>Productos</h2>
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

    <h2>Categorías</h2>
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

    <h2>Clientes</h2>
    @if($clientes->isNotEmpty())
        <ul class="list-group">
            @foreach($clientes as $cliente)
                <li class="list-group-item">
                    {{ $cliente->nombre }} - {{ $cliente->correo }}
                    <a href="{{ route('vendedor.ventas.index', ['search' => $cliente->nombre]) }}" class="btn btn-info btn-sm float-right">Ver</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron clientes.</p>
    @endif
</section>
@endsection
