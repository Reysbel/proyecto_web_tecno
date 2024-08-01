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
            <h2 class="section-title">Crear Delivery</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Delivery</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tablas.delivery.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre_apellido">Nombre y Apellido</label>
                            <input type="text" name="nombre_apellido" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input type="text" name="placa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ci">CI</label>
                            <input type="text" name="ci" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
