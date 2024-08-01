@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lista de Compras</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lista de Compras</div>
            </div>
        </div>
        <h1>Registrar Compra</h1>
        <form action="{{ route('admin.tablas.compra.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="id_proveedor">Seleccionar Proveedor:</label>
                    <select name="id_proveedor" id="id_proveedor" class="form-control">
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->editorial }} - {{ $proveedor->encargado }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="nit_recibo">NIT Recibo:</label>
                    <input type="text" name="nit_recibo" id="nit_recibo" class="form-control" placeholder="000026">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="producto">Seleccionar Producto:</label>
                    <select id="producto" class="form-control">
                        @foreach (App\Models\Producto::all() as $producto)
                            <option value="{{ $producto->id_producto }}">{{ $producto->codigo }} - {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" class="form-control" placeholder="Cantidad">
                </div>
                <div class="col">
                    <label for="precio_compra">Precio Compra:</label>
                    <input type="number" id="precio_compra" class="form-control" step="0.01"
                        placeholder="Precio Compra">

                </div>
                <div class="col">
                    <label for="precio_venta">Precio Venta:</label>
                    <input type="number" id="precio_venta" class="form-control" step="0.01" placeholder="Precio Venta">
                </div>
                <div class="col">
                    <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
                </div>

            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="detalle_compra">
                    <!-- Detalle de compra se llenará aquí -->
                </tbody>
            </table>
            <h3>Total: <span id="total">0</span></h3>
            <input type="hidden" name="total_compra" id="total_compra" value="0">

            <button type="submit" class="btn btn-success">Confirmar Compra</button>
        </form>
    </div>

    <script>
        document.getElementById('agregar').addEventListener('click', function() {
            const productoSelect = document.getElementById('producto');
            const productoText = productoSelect.options[productoSelect.selectedIndex].text;
            const productoId = productoSelect.value;
            const cantidad = document.getElementById('cantidad').value;
            const precioCompra = document.getElementById('precio_compra').value;
            const precioVenta = document.getElementById('precio_venta').value;
            const subtotal = (cantidad * precioCompra).toFixed(2);

            const row = `<tr>
            <td><button type="button" class="btn btn-danger btn-sm eliminar">Eliminar</button></td>
            <td>${productoText}</td>
            <td><input type="number" name="productos[${productoId}][cantidad]" value="${cantidad}" class="form-control"></td>
            <td><input type="number" name="productos[${productoId}][precio_compra]" value="${precioCompra}" class="form-control"></td>
            <td><input type="number" name="productos[${productoId}][precio_venta]" value="${precioVenta}" class="form-control"></td>
            <td>${subtotal}</td>
        </tr>`;

            document.getElementById('detalle_compra').insertAdjacentHTML('beforeend', row);

            actualizarTotal();

            // Agregar funcionalidad de eliminar
            document.querySelectorAll('.eliminar').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('tr').remove();
                    actualizarTotal();
                });
            });
        });

        function actualizarTotal() {
            let total = 0;
            document.querySelectorAll('#detalle_compra tr').forEach(row => {
                total += parseFloat(row.children[5].textContent);
            });
            document.getElementById('total').textContent = total.toFixed(2);
            document.getElementById('total_compra').value = total.toFixed(2);
        }
    </script>
@endsection
