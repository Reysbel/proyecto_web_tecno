@extends('vendedor.layouts.master')
@section('content')
<div class="container">
    <h1>Clientes</h1>
    <a href="{{ route('vendedor.lclientes.create') }}" class="btn btn-primary mb-3">Agregar Cliente</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_lcliente }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->celular }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>
                        <a href="{{ route('vendedor.lclientes.show', $cliente->id_lcliente) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('vendedor.lclientes.edit', $cliente->id_lcliente) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('vendedor.lclientes.destroy', $cliente->id_lcliente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clientes->links() }}
</div>
@endsection
