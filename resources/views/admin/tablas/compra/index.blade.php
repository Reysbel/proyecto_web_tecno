@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lista de Compras</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lista de Compras</div>
            </div>
        </div>
    <h1>Compras</h1>
    <a href="{{ route('admin.tablas.compra.create') }}" class="btn btn-primary">Crear Nueva Compra</a>
    <form action="{{ route('admin.tablas.compra.index') }}" method="GET">
        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar por NIT o fecha">
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIT Recibo</th>
                <th>Fecha</th>
                <th>Total Compra</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->id_compra }}</td>
                    <td>{{ $compra->nit_recibo }}</td>
                    <td>{{ $compra->fecha }}</td>
                    <td>{{ $compra->total_compra }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.tablas.compra.show', $compra->id_compra) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('admin.tablas.compra.edit', $compra->id_compra) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.tablas.compra.destroy', $compra->id_compra) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta compra?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
