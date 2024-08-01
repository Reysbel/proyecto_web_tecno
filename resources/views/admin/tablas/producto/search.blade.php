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

        <form action="{{ route('admin.tablas.producto.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar producto" name="q">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        @if ($productos->isEmpty())
            <div class="alert alert-info">No se encontraron productos.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
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
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->estado }}</td>
                                <td>{{ $producto->categoria->nombre }}</td>
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
