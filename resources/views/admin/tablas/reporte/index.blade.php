@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Reporte</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Reporte</div>
        </div>
    </div>
    <a href="{{ route('admin.tablas.reporte.create') }}" class="btn btn-primary mb-3">Crear Nuevo Reporte</a>

    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total Caja</th>
                    <th>Ingresos</th>
                    <th>Egresos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->id_reporte }}</td>
                        <td>{{ $reporte->fecha }}</td>
                        <td>${{ number_format($reporte->total_caja, 2) }}</td>
                        <td>${{ number_format($reporte->ingreso, 2) }}</td>
                        <td>${{ number_format($reporte->egreso, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.tablas.reporte.show', $reporte->id_reporte) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay reportes disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $reportes->links() }}
    </div>
</div>
@endsection
