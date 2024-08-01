@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Crear Nuevo Reporte</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Crear Reporte</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles del Reporte</h4>
                    </div>
                    <div class="card-body">
                        <form id="reporteForm" action="{{ route('admin.tablas.reporte.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_final">Fecha Final</label>
                                        <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                                    </div>
                                </div>
                                <div class="col-md-4 align-self-end">
                                    <button type="button" id="procesarBtn" class="btn btn-primary btn-block">Procesar</button>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total_caja">Total Caja</label>
                                        <input type="number" class="form-control" id="total_caja" name="total_caja" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ingreso">Ingreso</label>
                                        <input type="number" class="form-control" id="ingreso" name="ingreso" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="egreso">Egreso</label>
                                        <input type="number" class="form-control" id="egreso" name="egreso" required readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Guardar Reporte</button>
                        </form>

                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <h4>Detalles de Ingresos</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Factura</th>
                                            <th>Fecha</th>
                                            <th>Total Factura</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleIngresos">
                                        <!-- Ingresos se llenarán aquí -->
                                    </tbody>
                                </table>
                                <h4 class="text-right">Total Ingresos: <span id="totalIngresos">0</span></h4>
                            </div>
                            <div class="col-lg-6">
                                <h4>Detalles de Egresos</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Compra</th>
                                            <th>Fecha</th>
                                            <th>Total Compra</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleEgresos">
                                        <!-- Egresos se llenarán aquí -->
                                    </tbody>
                                </table>
                                <h4 class="text-right">Total Egresos: <span id="totalEgresos">0</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('procesarBtn').addEventListener('click', function() {
    let fechaInicio = document.getElementById('fecha_inicio').value;
    let fechaFinal = document.getElementById('fecha_final').value;

    fetch(`/admin/reportes/obtener-detalles?fecha_inicio=${fechaInicio}&fecha_final=${fechaFinal}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Hubo un problema con la petición HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            let ingresos = data.ingresos;
            let egresos = data.egresos;

            let detalleIngresos = document.getElementById('detalleIngresos');
            let detalleEgresos = document.getElementById('detalleEgresos');
            
            detalleIngresos.innerHTML = '';
            detalleEgresos.innerHTML = '';

            let totalIngresos = 0;
            ingresos.forEach(ingreso => {
                totalIngresos += parseFloat(ingreso.total_factura);
                detalleIngresos.innerHTML += `
                    <tr>
                        <td>${ingreso.id_factura}</td>
                        <td>${ingreso.fecha}</td>
                        <td>${ingreso.total_factura}</td>
                    </tr>
                `;
            });
            document.getElementById('totalIngresos').textContent = totalIngresos.toFixed(2);

            let totalEgresos = 0;
            egresos.forEach(egreso => {
                totalEgresos += parseFloat(egreso.total_compra);
                detalleEgresos.innerHTML += `
                    <tr>
                        <td>${egreso.id_compra}</td>
                        <td>${egreso.fecha}</td>
                        <td>${egreso.total_compra}</td>
                    </tr>
                `;
            });
            document.getElementById('totalEgresos').textContent = totalEgresos.toFixed(2);

            // Calcular y mostrar el total de caja
            let totalCaja = totalIngresos - totalEgresos;
            document.getElementById('total_caja').value = totalCaja.toFixed(2); // Asegura que el valor sea redondeado a 2 decimales
            document.getElementById('ingreso').value = totalIngresos.toFixed(2);
            document.getElementById('egreso').value = totalEgresos.toFixed(2);
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            // Aquí puedes manejar el error según sea necesario
        });
});
</script>
@endsection
