@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Nuevo Producto</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Nuevo Producto</div>
            </div>
        </div>

        <form action="{{ route('admin.tablas.registro_compra.store_produc') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $nombre }}">
                </div>
                <div class="col">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>
                <div class="col">
                    <label for="editorial">Editorial</label>
                    <input type="text" class="form-control" id="editorial" name="editorial" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="breve_descripcion">Breve Descripción</label>
                    <input type="text" class="form-control" id="breve_descripcion" name="breve_descripcion">
                </div>
                <div class="col">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <div class="col">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col">
                    <label for="id_categoria">Categoría</label>
                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </section>
@endsection
