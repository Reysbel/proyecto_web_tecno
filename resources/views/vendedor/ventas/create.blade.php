@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h1>Crear Factura</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vendedor.ventas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="cliente_id">Seleccionar Cliente Existente:</label>
                <select name="cliente_id" id="cliente_id" class="form-control">
                    <option value="">Seleccionar cliente...</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_lcliente }}">{{ $cliente->nombre }} ({{ $cliente->correo }})</option>
                    @endforeach
                </select>
            </div>

            <hr>

            <h3>Datos del Nuevo Cliente (si es necesario)</h3>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" name="celular" id="celular" class="form-control" value="{{ old('celular') }}">
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
            </div>

            <hr>
            <!-- Método de Pago -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="metodo_pago" class="form-label">Método de Pago:</label>
                    <select name="metodo_pago" class="form-control" id="metodo_pago">
                        <option value="efectivo">Efectivo</option>
                        <option value="pagofacil">PagoFacil</option>
                        <option value="tigomoney">TigoMoney</option>
                    </select>
                </div>
            </div>

            <!-- NIT -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="nit" class="form-label">NIT:</label>
                    <input type="text" name="nit" class="form-control" id="nit">
                </div>
            </div>

            <!-- Sección de Productos -->
            <div class="row mb-3">
                <label for="productos" class="form-label">Seleccionar Producto:</label>
                <div class="col-md-4">
                    <select class="form-control" id="productos">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}"
                                data-stock="{{ $producto->stock }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Mostrar el stock seleccionado -->
                <div class="col-md-2">
                    <p class="mt-2">Stock: <span id="stockProductoSeleccionado">0</span></p>
                </div>

                <div class="col-md-2">
                    <input type="number" id="cantidad" class="form-control mt-2" placeholder="Cantidad">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mt-2" id="agregarProducto">Agregar</button>
                </div>
            </div>

            <!-- Tabla de Detalle de Venta -->
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="detalleVenta">
                            <!-- Aquí se agregarán los productos -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totales -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sub_total" class="form-label">Sub Total:</label>
                        <input type="number" name="sub_total" class="form-control" id="sub_total" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="descuento" class="form-label">Descuento:</label>
                        <input type="number" name="descuento" class="form-control" id="descuento">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_factura" class="form-label">Total Factura:</label>
                        <input type="number" name="total_factura" class="form-control" id="total_factura" readonly>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="row">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('vendedor.ventas.index') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('productos').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var stock = selectedOption.getAttribute('data-stock');
            document.getElementById('stockProductoSeleccionado').textContent = stock;
        });

        document.getElementById('agregarProducto').addEventListener('click', function() {
            var productos = document.getElementById('productos');
            var cantidad = parseInt(document.getElementById('cantidad').value);
            var productoId = productos.value;
            var productoNombre = productos.options[productos.selectedIndex].text;
            var precioVenta = parseFloat(productos.options[productos.selectedIndex].getAttribute('data-precio'));
            var descuento = parseFloat(document.getElementById('descuento').value) || 0;
            var stockDisponible = parseInt(productos.options[productos.selectedIndex].getAttribute('data-stock'));

            // Verificar si la cantidad seleccionada es mayor que el stock disponible
            if (cantidad > stockDisponible) {
                alert('Stock insuficiente. Selecciona una cantidad menor o igual a ' + stockDisponible);
                cantidad = stockDisponible; // Vender solo la cantidad disponible en stock
            }

            var subTotal = (precioVenta - descuento) * cantidad;

            var fila = '<tr>';
            fila += '<td>' + productoNombre + '</td>';
            fila += '<td><input type="number" name="productos[' + productoId + '][cantidad]" value="' + cantidad +
                '" class="form-control"></td>';
            fila += '<td>' + precioVenta.toFixed(2) + '</td>';
            fila += '<td>' + descuento.toFixed(2) + '</td>';
            fila += '<td>' + subTotal.toFixed(2) + '</td>';
            fila += '</tr>';

            document.getElementById('detalleVenta').insertAdjacentHTML('beforeend', fila);

            // Actualizar el stock disponible
            stockDisponible -= cantidad;
            productos.options[productos.selectedIndex].setAttribute('data-stock', stockDisponible);
            document.getElementById('stockProductoSeleccionado').textContent = stockDisponible;

            actualizarTotales();
        });

        function actualizarTotales() {
            var subTotal = 0;
            document.querySelectorAll('#detalleVenta tr').forEach(function(row) {
                var cantidad = parseInt(row.querySelector('input[name*="[cantidad]"]').value);
                var precioVenta = parseFloat(row.cells[2].innerText);
                var descuento = parseFloat(row.cells[3].innerText);
                subTotal += (precioVenta - descuento) * cantidad;
            });

            var descuentoTotal = parseFloat(document.getElementById('descuento').value) || 0;
            var totalFactura = subTotal - descuentoTotal;

            document.getElementById('sub_total').value = subTotal.toFixed(2);
            document.getElementById('total_factura').value = totalFactura.toFixed(2);
        }
    </script>
@endsection
