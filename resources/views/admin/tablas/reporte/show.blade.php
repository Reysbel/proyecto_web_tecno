@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detalles del Reporte</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Detalles del Reporte</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Detalles del Reporte</h2>
        <p class="section-lead">Aquí puedes ver todos los detalles del reporte seleccionado.</p>

        <div class="card">
            <div class="card-header">
                <h4>Reporte ID: {{ $reporte->id_reporte }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.tablas.reporte.print', $reporte->id_reporte) }}" class="btn btn-icon icon-left btn-secondary"><i class="fas fa-print"></i> Imprimir</a>
                    <a href="{{ route('admin.tablas.reporte.index') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>ID:</strong> {{ $reporte->id_reporte }}
                        </div>
                        <div class="mb-3">
                            <strong>Fecha:</strong> {{ $reporte->fecha }}
                        </div>
                        <div class="mb-3">
                            <strong>Total Caja:</strong> ${{ number_format($reporte->total_caja, 2) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Ingresos:</strong> ${{ number_format($reporte->ingreso, 2) }}
                        </div>
                        <div class="mb-3">
                            <strong>Egresos:</strong> ${{ number_format($reporte->egreso, 2) }}
                        </div>
                        <div class="mb-3">
                            <strong>Creado por:</strong> {{ $reporte->user->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
