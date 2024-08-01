@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h2>Detalles del Pedido Web #{{ $pedido->id_pedido }}</h2>

        <div class="card mt-3">
            <div class="card-header">
                <h3>Información de la Factura</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Datos del Cliente</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Pedido</th>
                                    <td>{{ $pedido->pedido }}</td>
                                </tr>
                                <tr>
                                    <th>Cliente</th>
                                    <td>{{ $pedido->factura->cliente->name }}</td>
                                </tr>
                                <tr>
                                    <th>Ubicación</th>
                                    <td>{{ $pedido->ubicacion }}</td>
                                </tr>
                                <tr>
                                    <th>Referencia de Ubicación</th>
                                    <td>{{ $pedido->referencia_ubicacion }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono de Referencia</th>
                                    <td>{{ $pedido->telefono_referencia }}</td>
                                </tr>

                                <tr>
                                    <th>Nota</th>
                                    <td>{{ $pedido->nota }}</td>
                                </tr>
                                <tr>
                                    <th>Total Factura</th>
                                    <td>{{ $pedido->factura->total_factura }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3>Detalles del pedido</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedido->factura->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->producto->precio }}</td>
                                        <td>{{ $detalle->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Tiempo de Demora</th>
                                    <td>{{ $pedido->tiempo_demora }}</td>
                                </tr>
                                <tr>
                                    <th>Estado del Pedido</th>
                                    <td>{{ $pedido->pedido_estado }}</td>
                                </tr>
                                <tr>
                                    <th>delivery</th>
                                    <td>{{ $pedido->delivery ? $pedido->delivery->nombre_apellido : 'No asignado' }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('vendedor.pedidoweb.edit', $pedido->id_pedido) }}" class="btn btn-primary">Gestionar
                    pedido</a>
                < <a href="{{ route('vendedor.pedidoweb.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    @endsection
