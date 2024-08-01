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
        <h1>Edit Delivery</h1>
        <form action="{{ route('admin.tablas.delivery.update', $delivery->id_delivery) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="nombre_apellido">Nombre y Apellido</label>
            <input type="text" name="nombre_apellido" value="{{ $delivery->nombre_apellido }}" required>
            <label for="placa">Placa</label>
            <input type="text" name="placa" value="{{ $delivery->placa }}" required>
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" value="{{ $delivery->telefono }}">
            <button type="submit">Update</button>
        </form>


    </section>
@endsection
