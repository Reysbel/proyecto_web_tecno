@extends('vendedor.layouts.master')
@section('content'))
    <h1>Detalle del Cliente</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $cliente->id_lcliente }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $cliente->nombre }}</td>
        </tr>
        <tr>
            <th>Celular</th>
            <td>{{ $cliente->celular }}</td>
        </tr>
        <tr>
            <th>Correo</th>
            <td>{{ $cliente->correo }}</td>
        </tr>
    </table>
    <a href="{{ route('vendedor.lclientes.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
