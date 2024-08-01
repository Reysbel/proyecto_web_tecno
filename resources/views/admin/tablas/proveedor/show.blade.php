@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detalles del Pedido Web</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.tablas.pedido_web.index') }}">Lista de Pedidos Web</a></div>
                <div class="breadcrumb-item">Detalles del Pedido Web</div>
            </div>
        </div>
    <h1 class="mb-4">Detalles del Proveedor</h1>

    <div class="mb-3">
        <label class="form-label">Encargado</label>
        <p class="form-control">{{ $proveedor->encargado }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Editorial</label>
        <p class="form-control">{{ $proveedor->editorial }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">CI</label>
        <p class="form-control">{{ $proveedor->ci }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <p class="form-control">{{ $proveedor->telefono }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Correo</label>
        <p class="form-control">{{ $proveedor->correo }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Dirección</label>
        <p class="form-control">{{ $proveedor->direccion }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Estado</label>
        <p class="form-control">{{ $proveedor->estado }}</p>
    </div>
    <a href="{{ route('admin.tablas.proveedor.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
