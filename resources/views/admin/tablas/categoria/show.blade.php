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
        <h1>Detalles de la Categoría</h1>

        <div class="card">
            <div class="card-header">
                {{ $categoria->nombre }}
            </div>
            <div class="card-body">
                <h5 class="card-title">ID: {{ $categoria->id_categoria }}</h5>
                @if ($categoria->imagen)
                    <p class="card-text">
                        <img src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                            width="150">
                    </p>
                @endif
                <a href="{{ route('admin.tablas.categoria.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>


    </section>
@endsection
