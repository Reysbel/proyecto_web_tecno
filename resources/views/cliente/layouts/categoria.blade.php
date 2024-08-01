@extends('cliente.layouts.master')

@section('content')
<div class="container mt-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Categorías</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    @foreach($categorias as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cliente.layouts.categoria', $cat->id_categoria) }}">{{ $cat->nombre }}</a>
                    </li>
                    @endforeach
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="card mt-3">
        @isset($categoria)
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0 text-center py-2 text-sm">Productos de la Categoría: {{ $categoria->nombre }}</h4>
        </div>
        @endisset
        <div class="card-body">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
                @isset($productos)
                @forelse ($productos as $producto)
                <div class="col mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($producto->imagen)
                        <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="Imagen del producto">
                        @else
                        <img src="{{ asset('images/default-product.jpg') }}" class="card-img-top" alt="Imagen por defecto">
                        @endif
                        <div class="card-body p-2">
                            <h6 class="card-title text-center">{{ $producto->nombre }}</h6>
                            <p class="card-text text-center">Bs.{{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div class="card-footer p-1">
                            <form action="{{ route('cliente.carrito.agregar', $producto->id_producto) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm btn-block">
                                    <i class="fas fa-cart-plus"></i> Añadir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col">
                    <p>No hay productos disponibles en esta categoría.</p>
                </div>
                @endforelse
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection
