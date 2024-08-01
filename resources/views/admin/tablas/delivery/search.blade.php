@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crear Categoría</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Crear Categoría</div>
            </div>
        </div>

        <h1>Search Results</h1>
        <ul>
            @foreach ($deliverys as $delivery)
                <li>{{ $delivery->nombre_apellido }} - {{ $delivery->placa }}</li>
            @endforeach
        </ul>

    </section>
@endsection
