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
            <h2 class="section-title">Deliverys</h2>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Lista de Deliverys</h3>
                <a href="{{ route('admin.tablas.delivery.create') }}" class="btn btn-primary">Crear Nuevo Delivery</a>
            </div>

            <form action="{{ route('admin.tablas.delivery.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Buscar Deliverys" value="{{ request()->input('query') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>

            <div class="row">
                @forelse ($deliverys as $delivery)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $delivery->nombre_apellido }}</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Placa:</strong> {{ $delivery->placa }}</p>
                                <p><strong>Teléfono:</strong> {{ $delivery->telefono }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.tablas.delivery.show', $delivery->id_delivery) }}" class="btn btn-info">Ver</a>
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
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            No se encontraron deliverys.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
