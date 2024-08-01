@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crear Nueva Promoción</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.promocion.index') }}">Promociones</a></div>
                <div class="breadcrumb-item">Crear Promoción</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Nueva Promoción</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tablas.promocion.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id_producto" class="form-label">Producto</label>
                            <select name="id_producto" class="form-control" id="id_producto" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}">
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="descripcion">{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" name="descuento" class="form-control" id="descuento" value="{{ old('descuento') }}" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ old('fecha_fin') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Crear Promoción</button>
                        <a href="{{ route('admin.tablas.promocion.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
