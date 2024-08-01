@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Listado de Facturas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Listado de Facturas</div>
            </div>
        </div>

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Facturas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>NIT</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    <tr>
                                        <td>{{ $factura->id }}</td>
                                        <td>
                                            @if ($factura->tipo_cliente == 'local')
                                                {{ $factura->lcliente->nombre }}
                                            @elseif ($factura->tipo_cliente == 'web' && $factura->cliente)
                                                {{ $factura->cliente->name }}
                                            @else
                                                Cliente no especificado
                                            @endif
                                        </td>
                                        <td>{{ $factura->nit }}</td>
                                        <td>{{ $factura->fecha }}</td>
                                        <td>{{ $factura->total_factura }}</td>
                                        <td>{{ $factura->estado_factura }}</td>
                                        <td>
                                            
                                         
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
