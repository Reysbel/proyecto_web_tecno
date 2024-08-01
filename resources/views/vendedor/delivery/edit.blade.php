@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h1>Editar Delivery</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('vendedor.delivery.update', $delivery->id_delivery) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre_apellido" class="form-label">Nombre y Apellido</label>
                        <input type="text" class="form-control" id="nombre_apellido" name="nombre_apellido" value="{{ old('nombre_apellido', $delivery->nombre_apellido) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa', $delivery->placa) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $delivery->telefono) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('vendedor.delivery.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
