@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detalles del Pedido Web</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.pedido_web.index') }}">Lista de Pedidos Web</a></div>
                <div class="breadcrumb-item">Detalles del Pedido Web</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detalles del Pedido Web</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Información del Pedido</h4>
                </div>
                <div class="card-body">
                    <p><strong>ID Pedido:</strong> {{ $pedido->id_pedido }}</p>
                    <p><strong>Ubicación:</strong> {{ $pedido->ubicacion }}</p>
                    <p><strong>Referencia de Ubicación:</strong> {{ $pedido->referencia_ubicacion }}</p>
                    <p><strong>Teléfono de Referencia:</strong> {{ $pedido->telefono_referencia }}</p>
                    <p><strong>Tiempo de Demora:</strong> {{ $pedido->tiempo_demora }}</p>
                    <p><strong>Nota:</strong> {{ $pedido->nota }}</p>
                    <p><strong>Pedido:</strong> {{ $pedido->pedido }}</p>
                    <p><strong>Estado del Pedido:</strong> {{ $pedido->pedido_estado }}</p>
                    <p><strong>ID Factura:</strong> {{ $pedido->id_factura }}</p>
                    <p><strong>ID Delivery:</strong> {{ $pedido->id_delivery }}</p>
                    <p><strong>ID Usuario:</strong> {{ $pedido->user_id }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Detalles de la Factura</h4>
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
                    <p><strong>Hora:</strong> {{ $factura->hora }}</p>
                    <p><strong>Sub Total:</strong> {{ $factura->sub_total }}</p>
                    <p><strong>Descuento:</strong> {{ $factura->descuento }}</p>
                    <p><strong>Total Factura:</strong> {{ $factura->total_factura }}</p>
                    <p><strong>Tipo Cliente:</strong> {{ $factura->tipo_cliente }}</p>
                    <p><strong>Método de Pago:</strong> {{ $factura->metodo_pago }}</p>
                    <p><strong>Estado Factura:</strong> {{ $factura->estado_factura }}</p>
                    <p><strong>Estado Pedido:</strong> {{ $factura->pedido_estado }}</p>
                    <p><strong>Listo:</strong> {{ $factura->listo ? 'Sí' : 'No' }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Detalles de los Productos</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factura->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
