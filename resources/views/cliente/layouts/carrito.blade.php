@extends('cliente.layouts.master')

@section('content')
    <div class="container">
        <h1>Detalle del Cliente</h1>
        @if (Auth::check())
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="card-text">Teléfono: {{ Auth::user()->phone }}</p>
                    <p class="card-text">Email: {{ Auth::user()->email }}</p>
                </div>
            </div>
        @endif
        <h1>Detalle del Carrito</h1>
        <form action="{{ route('cliente.carrito.realizarPedido') }}" method="POST">
            @csrf
            @if ($factura)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factura->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>
                                    <form action="{{ route('cliente.carrito.actualizar', $detalle->id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="cantidad" value="{{ $detalle->cantidad }}" min="1">
                                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                    </form>
                                </td>
                                <td>{{ $detalle->producto->precio }} Bs</td>
                                <td>{{ $detalle->total }} Bs</td>
                                <td>
                                    <form action="{{ route('cliente.carrito.eliminar', $detalle->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="tnMontoClienteEmpresa" value="{{ $factura->total_factura }}">
                <input type="hidden" name="tnCiNit" value="{{ $factura->nit }}">
                <input type="hidden" name="tcNombreUsuario" value="{{ Auth::user()->name }}">
                <input type="hidden" name="tnTelefono" value="{{ Auth::user()->phone }}">
                <input type="hidden" name="tcCorreo" value="{{ Auth::user()->email }}">
                <div class="text-right">
                    <h4>Total: {{ $factura->total_factura }} Bs</h4>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="tnCiNit">Nit/CI:</label>
                        <input type="text" name="tnCiNit" id="tnCiNit" class="form-control">
                    </div>

                    <div class="col">
                        <label for="tnTipoServicio">Tipo de Servicio:</label>
                        <select name="tnTipoServicio" id="tnTipoServicio" class="form-control">
                            <option value="1">Servicio QR</option>
                            <option value="2">Tigo Money</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="pedido">Tipo de Pedido:</label>
                        <select name="pedido" id="pedido" class="form-control">
                            <option value="domicilio">Domicilio</option>
                            <option value="local">Local</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="telefono_referencia">Teléfono de Referencia:</label>
                        <input type="text" name="telefono_referencia" id="telefono_referencia" class="form-control">
                    </div>
                    <div class="col">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="referencia_ubicacion">Referencia de Ubicación:</label>
                        <input type="text" name="referencia_ubicacion" id="referencia_ubicacion" class="form-control">
                    </div>
                    <div class="col">
                        <label for="nota">Nota:</label>
                        <textarea name="nota" id="nota" class="form-control"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Realizar Pedido</button>
            @else
                <p>No hay productos en el carrito.</p>
            @endif
        </form>
    </div>
@endsection
