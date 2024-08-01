@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editar Categoría</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Editar Categoría</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{ route('admin.tablas.categoria.update', $categoria->id_categoria) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <h4>Editar Categoría</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $categoria->nombre }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="imagen">Imagen Actual</label><br>
                                    @if ($categoria->imagen)
                                        <img src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}" style="max-width: 200px; margin-bottom: 10px;">
                                    @else
                                        <p>No hay imagen disponible</p>
                                    @endif
                                    <input id="imagen" type="file" class="form-control" name="imagen">
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
