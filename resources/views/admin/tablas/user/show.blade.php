@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detalles del Usuario</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Detalles del Usuario</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Nombre:</h5>
                            <p>{{ $user->name }}</p>
                            <h5>Nombre de Usuario:</h5>
                            <p>{{ $user->username ?: 'N/A' }}</p>
                            <h5>Teléfono:</h5>
                            <p>{{ $user->phone ?: 'N/A' }}</p>
                            <h5>Correo Electrónico:</h5>
                            <p>{{ $user->email }}</p>
                            <h5>Rol:</h5>
                            <p>{{ ucfirst($user->role) }}</p>
                            <h5>Estado:</h5>
                            <p>{{ ucfirst($user->status) }}</p>
                        </div>
                        <div class="col-md-6">
                            @if ($user->image)
                                <img src="{{ asset($user->image) }}" alt="Imagen de Perfil" class="img-fluid rounded">
                            @else
                                <p>No hay imagen de perfil.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.tablas.user.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('admin.tablas.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
