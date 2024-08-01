@extends('vendedor.layouts.master')

@section('content')

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

    <form action="{{ route('vendedor.carrito.nuevoPedido') }}" method="GET" class="mt-4">
        <button type="submit" class="btn btn-primary">Realizar Nuevo Pedido</button>
    </form>
</div>
@endsection
