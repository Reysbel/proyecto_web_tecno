@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buscar Productos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Buscar Productos</div>
            </div>
        </div>

        <div class="mb-4">
            <form action="{{ route('admin.tablas.producto.index') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar producto"
                        value="{{ old('search', $search) }}">
                </div>
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </form>
        </div>
        <a href="{{ route('admin.tablas.producto.create') }}" class="btn btn-primary mb-3">Crear Nuevo producto</a>

        @if ($productos->isEmpty())
            <div class="alert alert-info">No se encontraron productos.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th> <!-- Nueva columna para la imagen -->
                            <th>Nombre</th>
                            <th>total_venta</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id_producto }}</td>
                                <td>
                                    <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                        style="max-width: 100px;">
                                </td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->total_venta }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->estado }}</td>
                                <td>{{ $producto->categoria ? $producto->categoria->nombre : 'Sin categoría' }}</td>
                                <td>
                                    <a href="{{ route('admin.tablas.producto.show', $producto->id_producto) }}"
                                        class="btn btn-info">Ver</a>
                                    <a href="{{ route('admin.tablas.producto.edit', $producto->id_producto) }}"
                                        class="btn btn-primary">Editar</a>
                                    <form action="{{ route('admin.tablas.producto.destroy', $producto->id_producto) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
