@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Editar Compra</h1>
    <form action="{{ route('admin.tablas.compra.update', $compra->id_compra) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nit_recibo">NIT Recibo</label>
            <input type="text" class="form-control" id="nit_recibo" name="nit_recibo" value="{{ old('nit_recibo', $compra->nit_recibo) }}">
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $compra->fecha) }}">
        </div>
        <div class="form-group">
            <label for="total_compra">Total Compra</label>
            <input type="number" class="form-control" id="total_compra" name="total_compra" value="{{ old('total_compra', $compra->total_compra) }}">
        </div>
        <div class="form-group">
            <label for="id_proveedor">Proveedor</label>
            <select class="form-control" id="id_proveedor" name="id_proveedor">
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" {{ $proveedor->id_proveedor == $compra->id_proveedor ? 'selected' : '' }}>{{ $proveedor->encargado }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select class="form-control" id="user_id" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $compra->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
