@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Factura de Productos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Factura de Productos</div>
            </div>
        </div>
    </section>
    <div class="container mt-5">
        <h2>Resumen del Pedido</h2>
        <hr>

        <h3>Información de la factura:</h3>
        <p>Fecha: {{ $factura->fecha }}</p>
        <p>Total de la factura: bs.{{ number_format($factura->total_factura, 2) }}</p>
        @if ($factura->lcliente)
            <p>Cliente: {{ $factura->lcliente->nombre }}</p>
        @else
            <p>Cliente: N/A</p>
        @endif

        <h3>Detalle del Pedido:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalle_factura as $detalle)
                    <tr>
                        <td>{{ $detalle['producto']->descripcion }}</td>
                        <td>bs.{{ number_format($detalle['producto']->precio, 2) }}</td>
                        <td>{{ $detalle['cantidad'] }}</td>
                        <td>bs.{{ number_format($detalle['total'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
            <div class="row d-flex justify-content-center">
                <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
            </div>
        </div>

        <form action="{{ route('admin.carrito.nuevoPedido') }}" method="GET" class="mt-4">
            <button type="submit" class="btn btn-primary">Realizar Nuevo Pedido</button>
        </form>
    </div>
@endsection
