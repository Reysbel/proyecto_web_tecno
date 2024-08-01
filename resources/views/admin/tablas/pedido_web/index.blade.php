@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lista de Pedidos Web</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Lista de Pedidos Web</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pedidos Web</h2>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Lista de Pedidos Web</h3>
                <form action="{{ route('admin.tablas.pedido_web.index') }}" method="GET" class="form-inline">
                    <input type="text" name="query" class="form-control mr-2" placeholder="Buscar Pedidos"
                           value="{{ request()->input('query') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Pedido</th>
                            <th>Ubicación</th>
                            <th>Referencia de Ubicación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id_pedido }}</td>
                                <td>{{ $pedido->ubicacion }}</td>
                                <td>{{ $pedido->referencia_ubicacion }}</td>
                                <td>{{ $pedido->pedido_estado }}</td>
                                <td>
                                    <a href="{{ route('admin.tablas.pedido_web.show', ['id' => $pedido->id_pedido]) }}"
                                       class="btn btn-sm btn-primary">Ver Detalles</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No se encontraron pedidos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
