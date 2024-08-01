@extends('vendedor.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <!-- Productos Disponibles -->
        <div class="col-md-7">
            <h2>Productos Disponibles</h2>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="todos-productos-tab" data-bs-toggle="pill" data-bs-target="#todos-productos" type="button" role="tab" aria-controls="todos-productos" aria-selected="true">Todos los Productos</button>
                        </li>
                        @foreach ($categorias as $categoria)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="categoria-{{ $categoria->id_categoria }}-tab" data-bs-toggle="pill" data-bs-target="#categoria-{{ $categoria->id_categoria }}" type="button" role="tab" aria-controls="categoria-{{ $categoria->id_categoria }}" aria-selected="false">{{ $categoria->nombre }}</button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="todos-productos" role="tabpanel" aria-labelledby="todos-productos-tab">
                    <div class="row">
                        @foreach ($productos as $producto)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">bs.{{ $producto->total_venta }}</p>
                                    <form action="{{ route('agregar_al_carrito', ['id_producto' => $producto->id_producto]) }}" method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Agregar a Pedido</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @foreach ($categorias as $categoria)
                <div class="tab-pane fade" id="categoria-{{ $categoria->id_categoria }}" role="tabpanel" aria-labelledby="categoria-{{ $categoria->id_categoria }}-tab">
                    <div class="row">
                        @if (isset($productosPorCategoria[$categoria->id_categoria]))
                        @foreach ($productosPorCategoria[$categoria->id_categoria] as $producto)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">bs.{{ $producto->total_venta }}</p>
                                    <form action="{{ route('agregar_al_carrito', ['id_producto' => $producto->id_producto]) }}" method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Agregar a Pedido</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Carrito -->
        <div class="col-md-5">
            <h2>Carrito</h2>
            @if (count($carrito) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $id_producto => $detalle)
                    <tr>
                        <td>{{ $detalle['producto']->nombre }}</td>
                        <td>
                            <form action="{{ route('actualizar_cantidad', ['id_producto' => $id_producto]) }}" method="POST" class="form-inline">
                                @csrf
                                <input type="number" name="cantidad" value="{{ $detalle['cantidad'] }}" min="1" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                            </form>
                        </td>
                        <td>bs.{{ $detalle['total'] }}</td>
                        <td>
                            <form action="{{ route('eliminar_del_carrito', ['id_producto' => $id_producto]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Total: bs.{{ $total_carrito }}</strong></p>
            <form action="{{ route('vendedor.carrito.realizarPedido') }}" method="POST" id="realizar-pedido-form">
                @csrf
                <div class="form-group">
                    <label for="metodo_pago">Método de Pago:</label>
                    <select name="metodo_pago" id="metodo_pago" class="form-control">
                        <option value="efectivo">Efectivo</option>
                        <option value="pagofacil">Pagofacil</option>
                        <option value="tigomoney">Tigomoney</option>
                    </select>
                </div>
                <div id="nombre-info" class="form-group" style="display: none;">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div id="cliente-info" style="display: none;">
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" id="celular" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                </div>
                <div id="nit-info">
                    <div class="form-group">
                        <label for="nit">NIT:</label>
                        <input type="text" name="nit" id="nit" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="descuento">Descuento (%):</label>
                    <input type="number" name="descuento" id="descuento" class="form-control" min="0" max="10" value="0">
                </div>
                <button type="submit" class="btn btn-success">Realizar Pedido</button>
            </form>
            @else
            <p>El carrito está vacío.</p>
            @endif
        </div>
    </div>
</div>
<script>
document.getElementById('metodo_pago').addEventListener('change', function() {
    var metodoPago = this.value;
    var nombreInfo = document.getElementById('nombre-info');
    var clienteInfo = document.getElementById('cliente-info');
    if (metodoPago === 'efectivo') {
        nombreInfo.style.display = 'block';
        clienteInfo.style.display = 'none';
    } else {
        nombreInfo.style.display = 'block';
        clienteInfo.style.display = 'block';
    }
});
</script>
@endsection
