@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h1>Gestión de Deliveries</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <form action="{{ route('vendedor.delivery.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="nombre_apellido">Nombre y Apellido:</label>
                        <input type="text" name="nombre_apellido" id="nombre_apellido" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="placa">Placa:</label>
                        <input type="text" name="placa" id="placa" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Crear Delivery</button>
            </form>
        </div>

        <div class="mb-4">
            <form action="{{ route('vendedor.delivery.index') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar delivery" value="{{ old('search', $search) }}">
                </div>
                <button type="submit" class="btn btn-secondary mt-2">Buscar</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Placa</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliverys as $delivery)
                    <tr>
                        <td>{{ $delivery->nombre_apellido }}</td>
                        <td>{{ $delivery->placa }}</td>
                        <td>{{ $delivery->telefono }}</td>
                        <td>
                            <a href="{{ route('vendedor.delivery.show', $delivery->id_delivery) }}" class="btn btn-info">Mostrar</a>
                            <a href="{{ route('vendedor.delivery.edit', $delivery->id_delivery) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('vendedor.delivery.destroy', $delivery->id_delivery) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
