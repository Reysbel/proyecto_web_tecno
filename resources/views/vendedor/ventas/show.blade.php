@extends('vendedor.layouts.master')

@section('content')
<div class="container">
    <h1>Detalles de la Venta</h1>

    <div class="card mb-3">
        <div class="card-header">
            Factura #{{ $factura->id_factura }}
        </div>
        <div class="card-body">
            <p><strong>NIT:</strong> {{ $factura->nit }}</p>
            <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
            <p><strong>Hora:</strong> {{ $factura->hora }}</p>
            <p><strong>Total:</strong> {{ $factura->total_factura }}</p>
            <p><strong>Método de Pago:</strong> {{ $factura->metodo_pago }}</p>
        </div>
    </div>

    <h3>Productos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->descuento ?? 0 }}</td>
                    <td>{{ $detalle->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('vendedor.ventas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
