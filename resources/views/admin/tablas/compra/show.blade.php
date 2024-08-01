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
        <div class="container">
            <h1>Detalles de la Compra</h1>
            <div class="form-group">
                <label for="nit_recibo">NIT Recibo</label>
                <p>{{ $compra->nit_recibo }}</p>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <p>{{ $compra->fecha }}</p>
            </div>
            <div class="form-group">
                <label for="total_compra">Total Compra</label>
                <p>{{ $compra->total_compra }}</p>
            </div>
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <p>{{ $compra->proveedor->encargado }}</p>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <p>{{ $compra->user->name }}</p>
            </div>
            <a href="{{ route('admin.tablas.compra.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </section>
@endsection
