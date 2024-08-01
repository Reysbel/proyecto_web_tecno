@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lista de Categorías</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lista de Categorías</div>
            </div>
        </div>

        <div class="mb-4">
            <form action="{{ route('admin.tablas.categoria.index') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar categoría"
                        value="{{ old('search', $search) }}">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Buscar</button>
            </form>
            
        </div>>

        <a href="{{ route('admin.tablas.categoria.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <img src="{{ asset($categoria->imagen) }}" alt="Imagen de categora" style="max-width: 100px;">
                        </td>
                        <td>
                            <a href="{{ route('admin.tablas.categoria.show', $categoria->id_categoria) }}"
                                class="btn btn-info">Ver</a>
                            <a href="{{ route('admin.tablas.categoria.edit', $categoria->id_categoria) }}"
                                class="btn btn-primary">Editar</a>
                            <form action="{{ route('admin.tablas.categoria.destroy', $categoria->id_categoria) }}"
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
    </section>
@endsection
