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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tablas.categoria.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>


    </section>

@endsection
