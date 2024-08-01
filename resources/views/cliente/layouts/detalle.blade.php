@extends('cliente.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title">Detalle de la Factura</h2>
            <p class="card-text">Factura: {{ $factura->id_factura }}</p>
            <p class="card-text">Fecha: {{ $factura->fecha }}</p>
            <p class="card-text">Total Factura: ${{ number_format($factura->total_factura, 2) }}</p>

            <hr>

            <h3>Productos Comprados:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Total Venta Unitario</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $productosAgrupados = [];
                    @endphp
                    @foreach ($factura->detalles as $detalle)
                    @php
                    $productoId = $detalle->id_producto;
                    if (!isset($productosAgrupados[$productoId])) {
                        $productosAgrupados[$productoId] = [
                            'nombre' => $detalle->producto->nombre,
                            'total_venta' => $detalle->producto->total_venta,
                            'cantidad' => 0,
                            'total' => 0,
                        ];
                    }
                    $productosAgrupados[$productoId]['cantidad'] += $detalle->cantidad;
                    $productosAgrupados[$productoId]['total'] += $detalle->total;
                    @endphp
                    @endforeach

                    @foreach ($productosAgrupados as $producto)
                    <tr>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>Bs.{{ number_format($producto['total_venta'], 2) }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>Bs.{{ number_format($producto['total'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            <a href="{{ route('cliente.layouts.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection
