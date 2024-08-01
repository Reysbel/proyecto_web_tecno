@extends('vendedor.layouts.master')
@section('content')

<form action="{{ route('vendedor.pedidoweb.search') }}" method="GET" class="form-inline mb-3">
    <input type="text" name="query" class="form-control mr-2" placeholder="Buscar pedido...">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<ul class="nav nav-tabs" id="pedidoTabs" role="tablist">
    @foreach ($categorias as $categoria => $pedidosCategoria)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($categoria) }}-tab" data-toggle="tab" href="#{{ Str::slug($categoria) }}" role="tab" aria-controls="{{ Str::slug($categoria) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                {{ $categoria }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="pedidoTabsContent">
    @foreach ($categorias as $categoria => $pedidosCategoria)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($categoria) }}" role="tabpanel" aria-labelledby="{{ Str::slug($categoria) }}-tab">
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ubicación</th>
                        <th>Referencia Ubicación</th>
                        <th>Teléfono Referencia</th>
                        <th>Tiempo Demora</th>
                        <th>Nota</th>
                        <th>Pedido</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pedidosCategoria as $pedido)
                        <tr>
                            <td>{{ $pedido->id_pedido }}</td>
                            <td>{{ $pedido->ubicacion }}</td>
                            <td>{{ $pedido->referencia_ubicacion }}</td>
                            <td>{{ $pedido->telefono_referencia }}</td>
                            <td>{{ $pedido->tiempo_demora }}</td>
                            <td>{{ $pedido->nota }}</td>
                            <td>{{ $pedido->pedido }}</td>
                            <td>{{ $pedido->pedido_estado }}</td>
                            <td>
                                <a href="{{ route('vendedor.pedidoweb.show', $pedido->id_pedido) }}" class="btn btn-info btn-sm">Ver</a>
                                <form action="{{ route('vendedor.pedidoweb.destroy', $pedido->id_pedido) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
