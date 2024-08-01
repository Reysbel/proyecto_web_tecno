@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Registrar Compra</h1>
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

        <form action="{{ route('admin.tablas.registro_compra.store_compra') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="id_proveedor">Seleccionar Proveedor:</label>
        <select name="id_proveedor" id="id_proveedor" required>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nit_recibo">Nit Recibo:</label>
        <input type="text" name="nit_recibo" id="nit_recibo" required>
    </div>

    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
    </div>

    <div class="form-group">
        <label for="total_compra">Total Compra:</label>
        <input type="number" name="total_compra" id="total_compra" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
    </div>

    <div class="form-group">
        <label for="total">Total:</label>
        <input type="number" name="total" id="total" step="0.01" required>
    </div>

    <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">

    <button type="submit" class="btn btn-primary">Registrar Compra</button>
</form>

    </section>
@endsection
