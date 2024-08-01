@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editar Promoción</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.promocion.index') }}">Promociones</a></div>
                <div class="breadcrumb-item">Editar Promoción</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Promoción: {{ $promocion->nombre }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tablas.promocion.update', $promocion->id_promocion) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id_producto" class="form-label">Producto</label>
                            <select name="id_producto" class="form-control" id="id_producto" required>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}" {{ $promocion->id_producto == $producto->id_producto ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $promocion->nombre) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="descripcion">{{ old('descripcion', $promocion->descripcion) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" name="descuento" class="form-control" id="descuento" value="{{ old('descuento', $promocion->descuento) }}" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ old('fecha_inicio', $promocion->fecha_inicio->format('Y-m-d')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ old('fecha_fin', $promocion->fecha_fin->format('Y-m-d')) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('admin.tablas.promocion.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
