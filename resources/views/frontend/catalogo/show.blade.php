@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $producto->nombre }}</h1>
            <h2>{{ $producto->autor }}</h2>
            @if($producto->edad_minima && $producto->edad_maxima)
                <p class="badge bg-danger">De {{ $producto->edad_minima }} a {{ $producto->edad_maxima }} años</p>
            @endif
            <p>{{ $producto->descripcion }}</p>
            
            <div class="mt-4">
                <p><strong>Formatos disponibles:</strong></p>
                <p>Versión Papel (Tapa dura) - {{ $producto->precio }} €</p>
            </div>
            
            <p><strong>Editorial:</strong> {{ $producto->editorial }}</p>
            <p><strong>Autor:</strong> {{ $producto->autor }}</p>
            <p><strong>Stock:</strong> {{ $producto->stock }}</p>
            @if($producto->descuento)
                <p><strong>Descuento:</strong> {{ $producto->descuento }} €</p>
            @endif

            <div class="mt-4">
                <button class="btn btn-success" id="buy-button">COMPRAR</button>
                <p class="text-muted mt-2">Envío GRATIS en compras superiores a 20 €.</p>
            </div>

            <div class="mt-4">
                <a href="#" class="btn btn-outline-secondary">Zoom</a>
                <div class="mt-2">
                    <a href="#" class="btn btn-outline-secondary"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-secondary"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('buy-button').addEventListener('click', function() {
    alert('Debes iniciar sesión para comprar');
    window.location.href = '{{ route('login') }}';
});
</script>
@endsection
