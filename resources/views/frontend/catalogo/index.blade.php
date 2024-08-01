@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menu -->
        <nav class="col-12 bg-light py-2">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="{{ url('catalogo') }}" class="nav-link {{ Request::is('catalogo') ? 'active' : '' }}">Todos los productos</a>
                </li>
                @foreach ($categorias as $categoria)
                    <li class="nav-item">
                        <a href="{{ url('catalogo/' . $categoria->id_categoria) }}" class="nav-link {{ Request::is('catalogo/' . $categoria->id_categoria) ? 'active' : '' }}">{{ $categoria->nombre }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Main content -->
        <main class="col-md-12 py-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach ($productos as $producto)
                    <div class="col mb-4">
                        <div class="card border-0 shadow h-100">
                            <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text"><strong>Autor:</strong> {{ $producto->autor }}</p>
                                <p class="card-text">{{ $producto->breve_descripcion }}</p>
                                <p class="card-text text-muted"><del>Antes: Bs.{{ $producto->precio }}</del></p>
                                <p class="card-text text-danger"><strong>Descuento: Bs.{{ $producto->descuento }}</strong></p>
                                <p class="card-text"><strong>Precio: Bs.{{ $producto->total_venta }}</strong></p>
                                <a href="{{ url('producto/' . $producto->id_producto) }}" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($productos instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $productos->links() }}
            @endif
        </main>
    </div>
</div>
@endsection
