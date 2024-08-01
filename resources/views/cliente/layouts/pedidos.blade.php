@extends('cliente.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="my-3 text-center">Mis Pedidos</h1>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @php
                            $contador = 0;
                        @endphp
                        @foreach ($pedidos as $pedido)
                        <div class="col mb-4">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title">Pedido #{{ $contador }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Fecha: {{ $pedido->fecha }}</p>
                                    <p class="card-text">Total Factura: ${{ number_format($pedido->total_factura, 2) }}</p>
                                    <!-- Agrega más detalles relevantes aquí -->

                                    <a href="{{ route('cliente.carrito.detalle', ['id_factura' => $pedido->id_factura]) }}"
                                        class="btn btn-outline-primary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $contador++;
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
