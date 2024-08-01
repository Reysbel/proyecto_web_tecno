@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buscar Producto</h1>
        </div>

        <form action="{{ route('admin.tablas.registro_compra.index') }}" method="GET">
            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar por nombre del producto">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </form>
    </section>
@endsection
