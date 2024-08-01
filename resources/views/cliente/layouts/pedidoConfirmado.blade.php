@extends('cliente.layouts.master')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">¡Pedido Confirmado!</h4>
            <p>Tu pedido ha sido procesado con éxito. Gracias por tu compra.</p>
            <hr>
            <p class="mb-0">Puedes revisar tus pedidos en la sección de <a href="{{ route('cliente.carrito.pedidos') }}">Mis
                    Pedidos</a>.</p>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
            <div class="row d-flex justify-content-center">
                <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
            </div>
        </div>
        <a href="{{ route('cliente.carrito.ver') }}" class="btn btn-primary">Volver al Carrito</a>
    </div>
@endsection
