@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crear Nuevo Usuario</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Crear Nuevo Usuario</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tablas.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <select id="role" name="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen de Perfil</label>
                            <input type="file" id="image" name="image" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
