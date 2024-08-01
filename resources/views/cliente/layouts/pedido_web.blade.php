@extends('cliente.layouts.master')

@section('content')
    <div class="container mt-4">
        <h2>Confirmar Pedido</h2>

        <div class="row">
            <div class="col-md-6">
                <h3>Datos del Pedido</h3>
                <table class="table">
                    <tr>
                        <td><strong>Cliente:</strong></td>
                        <td>{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha:</strong></td>
                        <td>{{ $factura->fecha }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Factura:</strong></td>
                        <td>Bs.{{ number_format($factura->total_factura, 2) }}</td>
                    </tr>
                    <!-- Agregar más detalles de la factura según sea necesario -->
                </table>
            </div>
            <div class="col-md-6">
                <h3>Ubicación de Entrega</h3>
                <form action="{{ route('cliente.realizar_pedido') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="tipo_pedido">Tipo de Pedido:</label>
                        <select id="tipo_pedido" name="pedido" class="form-control" required>
                            <option value="domicilio">Entrega a Domicilio</option>
                            <option value="local">Pedido en Local</option>
                        </select>
                    </div>

                    <div id="div_telefono_referencia" class="form-group">
                        <label for="telefono_referencia">Teléfono de Referencia:</label>
                        <input type="text" id="telefono_referencia" name="telefono_referencia" class="form-control">
                    </div>

                    <div id="div_ubicacion" class="form-group" style="display: none;">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" id="ubicacion" name="ubicacion" class="form-control">
                    </div>

                    <div id="div_referencia_ubicacion" class="form-group" style="display: none;">
                        <label for="referencia_ubicacion">Referencia de Ubicación:</label>
                        <input type="text" id="referencia_ubicacion" name="referencia_ubicacion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nota">Nota:</label>
                        <textarea id="nota" name="nota" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Realizar Pedido</button>
                </form>

                <!-- Script JavaScript para mostrar u ocultar campos según el tipo de pedido -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const tipoPedidoSelect = document.getElementById('tipo_pedido');
                        const divTelefonoReferencia = document.getElementById('div_telefono_referencia');
                        const divUbicacion = document.getElementById('div_ubicacion');
                        const divReferenciaUbicacion = document.getElementById('div_referencia_ubicacion');

                        tipoPedidoSelect.addEventListener('change', function() {
                            const tipoPedido = tipoPedidoSelect.value;

                            if (tipoPedido === 'domicilio') {
                                divTelefonoReferencia.style.display = 'block';
                                divUbicacion.style.display = 'block';
                                divReferenciaUbicacion.style.display = 'block';
                            } else if (tipoPedido === 'local') {
                                divTelefonoReferencia.style.display = 'block';
                                divUbicacion.style.display = 'none';
                                divReferenciaUbicacion.style.display = 'none';
                            }
                        });

                        // Ejecutar el cambio de evento en carga para establecer la visibilidad correcta
                        tipoPedidoSelect.dispatchEvent(new Event('change'));
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
