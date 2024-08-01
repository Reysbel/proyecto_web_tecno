@extends('cliente.layouts.master')

@section('content')
    <!-- Sección de productos de categoria -->
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Productos en {{ $categoria->nombre }}</h1>
            </div>
        </div>
    </div>
    <section class="py-3">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($productos as $producto)
                    <div class="col mb-5">
                        <div class="card h-60">
                            <!-- Imagen del producto -->
                            @if ($producto->imagen)
                                <img class="card-img-top" src="{{ asset($producto->imagen) }}" alt="Imagen del producto">
                            @else
                                <img class="card-img-top" src="{{ asset('path/to/default/image.jpg') }}" alt="Imagen por defecto">
                            @endif
                            <!-- Detalles del producto -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Nombre del producto -->
                                    <h5 class="fw-bolder">{{ $producto->nombre }}</h5>
                                    <!-- Precio del producto -->
                                    {{ 'Bs.' . number_format($producto->precio, 2) }}
                                </div>
                            </div>
                            <!-- Acciones del producto -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form action="{{ route('cliente.carrito.agregar', $producto->id_producto) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-dark mt-auto" type="submit">Añadir a la cesta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
