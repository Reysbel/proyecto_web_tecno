@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editar Proveedor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.proveedor.index') }}">Lista de Proveedores</a></div>
                <div class="breadcrumb-item">Editar Proveedor</div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Proveedor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.tablas.proveedor.update', $proveedor->id_proveedor) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="encargado" class="form-label">Encargado</label>
                                    <input type="text" name="encargado" class="form-control" id="encargado" value="{{ old('encargado', $proveedor->encargado) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editorial" class="form-label">Editorial</label>
                                    <input type="text" name="editorial" class="form-control" id="editorial" value="{{ old('editorial', $proveedor->editorial) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ci" class="form-label">CI</label>
                                    <input type="text" name="ci" class="form-control" id="ci" value="{{ old('ci', $proveedor->ci) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="correo" value="{{ old('correo', $proveedor->correo) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select name="estado" class="form-control" id="estado" required>
                                        <option value="activo" {{ old('estado', $proveedor->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ old('estado', $proveedor->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.tablas.proveedor.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
