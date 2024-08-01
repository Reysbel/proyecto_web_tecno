@extends('vendedor.layouts.master')
@section('content')
<div class="container">
    <h1>Agregar Cliente</h1>
    <form action="{{ route('vendedor.lclientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('vendedor.lclientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
