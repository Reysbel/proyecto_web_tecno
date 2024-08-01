@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h2>Gestionar Pedido Web #{{ $pedido->id_pedido }}</h2>

        <form action="{{ route('vendedor.pedidoweb.update', $pedido->id_pedido) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mt-3">
                <div class="card-header">
                    <h3>Información del Pedido</h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="id_delivery">Delivery</label>
                        <select name="id_delivery" class="form-control">
                            @foreach ($deliveries as $delivery)
                                <option value="{{ $delivery->id_delivery }}"
                                    {{ $pedido->id_delivery == $delivery->id_delivery ? 'selected' : '' }}>
                                    {{ $delivery->nombre_apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tiempo_demora">Tiempo de Demora</label>
                        <input type="time" name="tiempo_demora" class="form-control"
                            value="{{ $pedido->tiempo_demora }}">
                    </div>

                    <div class="form-group">
                        <label for="pedido_estado">Estado del Pedido</label>
                        <select name="pedido_estado" class="form-control">
                            <option value="procesando" {{ $pedido->pedido_estado == 'procesando' ? 'selected' : '' }}>
                                Procesando</option>
                            <option value="pedido aceptado"
                                {{ $pedido->pedido_estado == 'pedido aceptado' ? 'selected' : '' }}>Pedido Aceptado</option>
                            <option value="enviado" {{ $pedido->pedido_estado == 'enviado' ? 'selected' : '' }}>Enviado
                            </option>
                            <option value="entregado" {{ $pedido->pedido_estado == 'entregado' ? 'selected' : '' }}>
                                Entregado</option>
                            <option value="no entregado" {{ $pedido->pedido_estado == 'no entregado' ? 'selected' : '' }}>
                                No
                                Entregado</option>
                        </select>
                    </div>

                    <label for="estado_factura">Estado de la Factura</label>
                    <select name="estado_factura" class="form-control">
                        <option value="pendiente" {{ $pedido->factura->estado_factura == 'pendiente' ? 'selected' : '' }}>
                            Pendiente</option>
                        <option value="pagada" {{ $pedido->factura->estado_factura == 'pagada' ? 'selected' : '' }}>
                            Pagada
                        </option>
                        <option value="anulada" {{ $pedido->factura->estado_factura == 'anulada' ? 'selected' : '' }}>
                            Anulada</option>
                    </select>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Guardar </button>
                    <a href="{{ route('vendedor.pedidoweb.index') }}" class="btn btn-primary">Cancelar</a>
                </div>
            </div>


            

        </form>
    </div>
@endsection
