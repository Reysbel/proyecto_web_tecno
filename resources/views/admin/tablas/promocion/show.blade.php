@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detalles de la Promoción</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.promocion.index') }}">Promociones</a></div>
                <div class="breadcrumb-item">Detalles</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $promocion->nombre }}</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Producto:</dt>
                        <dd class="col-sm-9">{{ $promocion->producto->nombre }}</dd>
                        <dt class="col-sm-3">Nombre:</dt>
                        <dd class="col-sm-9">{{ $promocion->nombre }}</dd>
                        <dt class="col-sm-3">Descripción:</dt>
                        <dd class="col-sm-9">{{ $promocion->descripcion }}</dd>
                        <dt class="col-sm-3">Descuento:</dt>
                        <dd class="col-sm-9">{{ $promocion->descuento }}%</dd>
                        <dt class="col-sm-3">Fecha Inicio:</dt>
                        <dd class="col-sm-9">{{ $promocion->fecha_inicio->format('d/m/Y') }}</dd>
                        <dt class="col-sm-3">Fecha Fin:</dt>
                        <dd class="col-sm-9">{{ $promocion->fecha_fin->format('d/m/Y') }}</dd>
                    </dl>
                    <a href="{{ route('admin.tablas.promocion.index') }}" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </section>
@endsection
