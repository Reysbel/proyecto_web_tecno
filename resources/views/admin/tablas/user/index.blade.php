@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lista de Usuarios</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lista de Usuarios</div>
            </div>
        </div>

        <form action="{{ route('admin.tablas.user.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar usuario" name="q">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <a href="{{ route('admin.tablas.user.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($users->isEmpty())
            <div class="alert alert-info">No se encontraron usuarios.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nombre de usuario</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    @if ($user->image)
                                        <img src="{{ asset($user->image) }}" alt="Imagen" width="100">
                                    @else
                                        No hay imagen
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tablas.user.show', $user->id) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('admin.tablas.user.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                                    <form action="{{ route('admin.tablas.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
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
