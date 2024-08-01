@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $producto->nombre }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Detalles del Producto</div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    @if ($producto->imagen)
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/300x450" alt="No hay imagen disponible" class="img-fluid">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">Autor: <strong>{{ $producto->autor }}</strong></p>
                        <p class="card-text">Editorial: <strong>{{ $producto->editorial }}</strong></p>
                        <p class="card-text">Categoría: <strong>{{ $producto->categoria->nombre }}</strong></p>
                        <p class="card-text">Breve Descripción: <strong>{{ $producto->breve_descripcion }}</strong></p>
                        <p class="card-text">Descripción: <strong>{{ $producto->descripcion }}</strong></p>
                        <p class="card-text">Precio de Compra: <strong>{{ $producto->precio_compra }} €</strong></p>
                        <p class="card-text">Precio: <strong>{{ $producto->precio }} €</strong></p>
                        <p class="card-text">Descuento: <strong>{{ $producto->descuento }} %</strong></p>
                        <p class="card-text">Total Venta: <strong>{{ $producto->total_venta }} €</strong></p>
                        <p class="card-text">Stock: <strong>{{ $producto->stock }}</strong></p>
                        <p class="card-text">Estado: <strong>{{ ucfirst($producto->estado) }}</strong></p>
                        <div class="btn-group mt-3" role="group">
                            <a href="{{ route('admin.tablas.producto.edit', $producto->id_producto) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('admin.tablas.producto.destroy', $producto->id_producto) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
