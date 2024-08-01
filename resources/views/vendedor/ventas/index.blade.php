@extends('vendedor.layouts.master')

@section('content')
<div class="container">
    <h1>Ventas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('vendedor.ventas.index') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Buscar por NIT o fecha" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIT</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Método de Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facturas as $factura)
                <tr>
                    <td>{{ $factura->nit }}</td>
                    <td>{{ $factura->fecha }}</td>
                    <td>{{ $factura->total_factura }}</td>
                    <td>{{ $factura->metodo_pago }}</td>
                    <td>
                        <a href="{{ route('vendedor.ventas.show', $factura->id_factura) }}" class="btn btn-info btn-sm">Ver</a>
                        <form action="{{ route('vendedor.ventas.destroy', $factura->id_factura) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta venta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron ventas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $facturas->links() }}
</div>
@endsection
