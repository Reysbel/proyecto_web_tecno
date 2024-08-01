@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crear Categoría</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Crear Categoría</div>
            </div>
        </div>
        <h1>Buscar Categorías</h1>

        <form action="{{ route('admin.tablas.categoria.search') }}" method="GET">
            <div class="form-group">
                <label for="query">Buscar</label>
                <input type="text" class="form-control" id="query" name="query"
                    value="{{ request()->input('query') }}">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        @if (isset($categorias))
            <h2>Resultados de la búsqueda</h2>
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
                                @if ($categoria->imagen)
                                    <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                        width="50">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tablas.categoria.show', $categoria->id_categoria) }}"
                                    class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.tablas.categoria.edit', $categoria->id_categoria) }}"
                                    class="btn btn-warning">Editar</a>
                                <form action="{{ route('admin.tablas.categoria.destroy', $categoria->id_categoria) }}" method="POST"
                                    style="display:inline-block;">
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

        @endif
    </section>
@endsection
