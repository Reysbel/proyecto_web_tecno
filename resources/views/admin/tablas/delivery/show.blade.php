@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crear Categoría</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Crear Categoría</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detalles del Delivery</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Información del Delivery</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nombre y Apellido:</strong> {{ $delivery->nombre_apellido }}</p>
                    <p><strong>Placa:</strong> {{ $delivery->placa }}</p>
                    <p><strong>Teléfono:</strong> {{ $delivery->telefono }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tablas.delivery.edit', $delivery->id_delivery) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.tablas.delivery.destroy', $delivery->id_delivery) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este delivery?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
