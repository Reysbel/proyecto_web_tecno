@extends('vendedor.layouts.master')

@section('content')
<div class="container">
    <h1>Editar Venta</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('vendedor.ventas.update', $factura->id_factura) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" name="nit" class="form-control" id="nit" value="{{ $factura->nit }}">
        </div>
        <div class="form-group">
            <label for="sub_total">Sub Total</label>
            <input type="number" name="sub_total" class="form-control" id="sub_total" value="{{ $factura->sub_total }}">
        </div>
        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" name="descuento" class="form-control" id="descuento" value="{{ $factura->descuento }}">
        </div>
        <div class="form-group">
            <label for="total_factura">Total Factura</label>
            <input type="number" name="total_factura" class="form-control" id="total_factura" value="{{ $factura->total_factura }}">
        </div>
        <div class="form-group">
            <label for="tipo_moneda">Tipo de Moneda</label>
            <input type="text" name="tipo_moneda" class="form-control" id="tipo_moneda" value="{{ $factura->tipo_moneda }}">
        </div>
        <div class="form-group">
            <label for="tipo_cliente">Tipo de Cliente</label>
            <input type="text" name="tipo_cliente" class="form-control" id="tipo_cliente" value="{{ $factura->tipo_cliente }}">
        </div>
        <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <select name="metodo_pago" class="form-control" id="metodo_pago">
                <option value="efectivo" {{ $factura->metodo_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="pagofacil" {{ $factura->metodo_pago == 'pagofacil' ? 'selected' : '' }}>PagoFacil</option>
                <option value="tigomoney" {{ $factura->metodo_pago == 'tigomoney' ? 'selected' : '' }}>TigoMoney</option>
            </select>
        </div>

        <h3>Productos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factura->detalleFacturas as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>
                            <input type="number" name="productos[{{ $detalle->id_producto }}][cantidad]" class="form-control" value="{{ $detalle->cantidad }}">
                        </td>
                        <td>
                            <input type="number" name="productos[{{ $detalle->id_producto }}][descuento]" class="form-control" value="{{ $detalle->descuento ?? 0 }}">
                        </td>
                        <td>{{ $detalle->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
    </form>
</div>
@endsection
