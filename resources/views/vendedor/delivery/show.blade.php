@extends('vendedor.layouts.master')

@section('content')
    <div class="container">
        <h1>Detalles del Delivery</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <h3>{{ $delivery->nombre_apellido }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Placa:</strong> {{ $delivery->placa }}</p>
                <p><strong>Teléfono:</strong> {{ $delivery->telefono ?: 'No especificado' }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('vendedor.delivery.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
