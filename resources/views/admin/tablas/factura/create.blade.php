@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Venta de Productos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Venta de Productos</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.tablas.factura.store') }}" method="POST">
                                @csrf

                                <!-- Datos del Cliente -->
                                <div class="form-group">
                                    <label for="tipo_cliente">Tipo de Cliente:</label>
                                    <select name="tipo_cliente" id="tipo_cliente" class="form-control" required>
                                        <option value="web">Cliente Web (Usuario registrado)</option>
                                        <option value="local">Cliente Local</option>
                                    </select>
                                </div>

                                <!-- Selección de Cliente Web -->
                                <div class="form-group" id="cliente_web_select" style="display: none;">
                                    <label for="id_cliente">Seleccionar Cliente Web:</label>
                                    <select name="id_cliente" id="id_cliente" class="form-control">
                                        <!-- Aquí debes listar los usuarios registrados como clientes web -->
                                        @foreach ($clientesWeb as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Formulario para Cliente Local -->
                                <div class="form-group" id="cliente_local_form" style="display: none;">
                                    <label for="id_lcliente">Seleccionar Cliente Local:</label>
                                    <select name="id_lcliente" id="id_lcliente" class="form-control">
                                        <!-- Aquí debes listar los clientes locales -->
                                        @foreach ($clientesLocales as $cliente)
                                            <option value="{{ $cliente->id_lcliente }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Detalle de Productos -->
                                <div class="form-group">
                                    <label>Productos:</label>
                                    <table class="table table-bordered" id="productos_table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="productos[0][id_producto]" class="form-control" required>
                                                        <option value="">Seleccionar Producto</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="productos[0][cantidad]" class="form-control" min="1" required></td>
                                                <td><input type="number" name="productos[0][precio_unitario]" class="form-control" min="0" step="0.01" required></td>
                                                <td>0.00</td>
                                                <td><button type="button" class="btn btn-danger btn-sm">Eliminar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm" id="agregar_producto">Agregar Producto</button>
                                </div>

                                <!-- Campos adicionales de la factura -->
                                <div class="form-group">
                                    <label for="nit">NIT:</label>
                                    <input type="text" name="nit" id="nit" class="form-control" value="{{ old('nit') }}" placeholder="NIT del cliente">
                                </div>

                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="hora">Hora:</label>
                                    <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}">
                                </div>

                                <div class="form-group">
                                    <label for="metodo_pago">Método de Pago:</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                        <option value="efectivo">Efectivo</option>
                                        <option value="pagofacil">PagoFacil</option>
                                        <option value="tigomoney">TigoMoney</option>
                                        <!-- Agregar más opciones según necesidad -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="estado_factura">Estado de la Factura:</label>
                                    <select name="estado_factura" id="estado_factura" class="form-control" required>
                                        <option value="pendiente">Pendiente</option>
                                        <option value="pagada">Pagada</option>
                                        <option value="anulada">Anulada</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pedido_estado">Estado del Pedido:</label>
                                    <select name="pedido_estado" id="pedido_estado" class="form-control" required>
                                        <option value="procesando">Procesando</option>
                                        <option value="enviado">Enviado</option>
                                        <option value="entregado">Entregado</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="listo">¿Está listo para entregar?</label>
                                    <select name="listo" id="listo" class="form-control" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Botón de enviar formulario -->
                                <button type="submit" class="btn btn-primary">Crear Factura</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Mostrar campos dependiendo del tipo de cliente seleccionado
            $('#tipo_cliente').change(function() {
                var tipoCliente = $(this).val();
                if (tipoCliente === 'web') {
                    $('#cliente_web_select').show();
                    $('#cliente_local_form').hide();
                } else if (tipoCliente === 'local') {
                    $('#cliente_web_select').hide();
                    $('#cliente_local_form').show();
                } else {
                    $('#cliente_web_select').hide();
                    $('#cliente_local_form').hide();
                }
            });

            // Calcular el total por producto al cambiar la cantidad o el precio unitario
            $('#productos_table').on('change', 'input[name^="productos["]', function() {
                var tr = $(this).closest('tr');
                var cantidad = tr.find('input[name^="productos["][name$="[cantidad]"]').val();
                var precioUnitario = tr.find('input[name^="productos["][name$="[precio_unitario]"]').val();
                var total = cantidad * precioUnitario;
                tr.find('td:nth-child(4)').text(total.toFixed(2));
            });

            // Agregar fila para nuevo producto
            $('#agregar_producto').click(function() {
                var rowCount = $('#productos_table tbody tr').length;
                var html = `
                    <tr>
                        <td>
                            <select name="productos[${rowCount}][id_producto]" class="form-control" required>
                                <option value="">Seleccionar Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="productos[${rowCount}][cantidad]" class="form-control" min="1" required></td>
                        <td><input type="number" name="productos[${rowCount}][precio_unitario]" class="form-control" min="0" step="0.01" required></td>
                        <td>0.00</td>
                        <td><button type="button" class="btn btn-danger btn-sm">Eliminar</button></td>
                    </tr>
                `;
                $('#productos_table tbody').append(html);
            });

            // Eliminar fila de producto
            $('#productos_table').on('click', '.btn-danger', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
