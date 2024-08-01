@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Proveedores</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.pedido_web.index') }}">Lista de Pedidos Web</a></div>
                <div class="breadcrumb-item">Proveedores</div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Proveedores</h2>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <form action="{{ route('admin.tablas.proveedor.index') }}" method="GET" class="d-flex w-50">
                            <input type="text" name="search" class="form-control me-2" placeholder="Buscar proveedor" value="{{ $search }}">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </form>
                        <a href="{{ route('admin.tablas.proveedor.create') }}" class="btn btn-success">Agregar Proveedor</a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Encargado</th>
                                        <th>Editorial</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->encargado }}</td>
                                            <td>{{ $proveedor->editorial }}</td>
                                            <td>{{ $proveedor->telefono }}</td>
                                            <td>{{ $proveedor->correo }}</td>
                                            <td>
                                                <span class="badge bg-{{ $proveedor->estado == 'Activo' ? 'success' : 'danger' }}">
                                                    {{ $proveedor->estado }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.tablas.proveedor.show', $proveedor->id_proveedor) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('admin.tablas.proveedor.edit', $proveedor->id_proveedor) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('admin.tablas.proveedor.destroy', $proveedor->id_proveedor) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No hay proveedores disponibles</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
