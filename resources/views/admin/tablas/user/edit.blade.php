@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editar Usuario</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Editar Usuario</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tablas.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <select id="role" name="role" class="form-control" required>
                                <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                <option value="vendedor" @if ($user->role == 'vendedor') selected @endif>Vendedor</option>
                                <option value="cliente" @if ($user->role == 'cliente') selected @endif>Cliente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="active" @if ($user->status == 'active') selected @endif>Activo</option>
                                <option value="inactive" @if ($user->status == 'inactive') selected @endif>Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <small>Deja este campo en blanco si no quieres cambiar la contraseña.</small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen de Perfil</label>
                            <input type="file" id="image" name="image" class="form-control-file">
                        </div>
                        @if ($user->image)
                            <div class="form-group">
                                <img src="{{ asset($user->image) }}" alt="Imagen de Perfil" class="img-fluid rounded">
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

