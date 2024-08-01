@extends('cliente.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0 text-center py-2 text-sm">Explora Nuestros Productos</h4>
        </div>
        <div class="card-body">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
                @foreach ($productos as $producto)
                <div class="col mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($producto->imagen)
                        <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="Imagen del producto">
                        @else
                        <img src="{{ asset('images/default-product.jpg') }}" class="card-img-top"
                            alt="Imagen por defecto">
                        @endif
                        <div class="card-body p-2">
                            <h6 class="card-title text-center">{{ $producto->nombre }}</h6>
                            <p class="card-text text-center">Bs.{{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div class="card-footer p-1">
                            <form action="{{ route('cliente.carrito.agregar', $producto->id_producto) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm btn-block">
                                    <i class="fas fa-cart-plus"></i> Añadir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
