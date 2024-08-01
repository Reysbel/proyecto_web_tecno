@extends('vendedor.layouts.master')
@section('content')
<div class="container">
    <h1>Editar Cliente</h1>
    <form action="{{ route('vendedor.lclientes.update', $cliente->id_lcliente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" value="{{ $cliente->celular }}" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->correo }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('vendedor.lclientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
