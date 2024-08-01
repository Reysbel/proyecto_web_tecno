@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Editar {{ $producto->nombre }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Editar Producto</div>
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

        <form action="{{ route('admin.tablas.producto.update', $producto->id_producto) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $producto->nombre }}" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="autor">Autor</label>
                            <input type="text" class="form-control" id="autor" name="autor"
                                value="{{ $producto->autor }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editorial">Editorial</label>
                            <input type="text" class="form-control" id="editorial" name="editorial"
                                value="{{ $producto->editorial }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breve_descripcion">Breve Descripción</label>
                        <input type="text" class="form-control" id="breve_descripcion" name="breve_descripcion"
                            value="{{ $producto->breve_descripcion }}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="precio_compra">Precio de Compra</label>
                            <input type="number" step="0.01" class="form-control" id="precio_compra"
                                name="precio_compra" value="{{ $producto->precio_compra }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                value="{{ $producto->precio }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="descuento">Descuento</label>
                            <input type="number" step="0.01" class="form-control" id="descuento" name="descuento"
                                value="{{ $producto->descuento }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="total_venta">Total Venta</label>
                            <input type="number" step="0.01" class="form-control" id="total_venta" name="total_venta"
                                value="{{ $producto->total_venta }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                                value="{{ $producto->stock }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="activo" {{ $producto->estado === 'activo' ? 'selected' : '' }}>Activo
                                </option>
                                <option value="inactivo" {{ $producto->estado === 'inactivo' ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_categoria">Categoría</label>
                            <select class="form-control" id="id_categoria" name="id_categoria" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}"
                                        {{ $producto->id_categoria === $categoria->id_categoria ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input id="imagen" type="file" class="form-control" name="imagen">
                    </div>
                    @if ($producto->imagen)
                        <div class="form-group">
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </section>
@endsection
