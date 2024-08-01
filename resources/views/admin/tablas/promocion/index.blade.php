@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Promociones</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Promociones</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('admin.tablas.promocion.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar promociones"
                                value="{{ $search }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('admin.tablas.promocion.create') }}" class="btn btn-success ml-3">Crear Promoción</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Descuento</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promociones as $promocion)
                                <tr>
                                    <td>{{ $promocion->id_promocion }}</td>
                                    <td>{{ $promocion->producto->nombre }}</td>
                                    <td>{{ $promocion->nombre }}</td>
                                    <td>{{ $promocion->descripcion }}</td>
                                    <td>{{ $promocion->descuento }}%</td>
                                    <td>{{ $promocion->fecha_inicio }}</td>
                                    <td>{{ $promocion->fecha_fin }}</td>
                                    <td>
                                        <a href="{{ route('admin.tablas.promocion.show', $promocion->id_promocion) }}" class="btn btn-info btn-sm mr-2">Ver</a>
                                        <a href="{{ route('admin.tablas.promocion.edit', $promocion->id_promocion) }}"
                                            class="btn btn-warning">Editar</a>
                                        <form action="{{ route('admin.tablas.promocion.destroy', $promocion->id_promocion) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar esta promoción?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $promociones->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
