@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1 class="display-4">Nuestra Empresa</h1>
        </div>
    </div>
    <div class="row my-5 align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('frontend/images/nuestra_empresa.jpg') }}" class="img-fluid rounded shadow" alt="Nuestra Empresa">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Antecedentes y Justificación</h2>
            <h3 class="mb-2">Antecedentes</h3>
            <p>La empresa “Casa del Libro” asentada en la ciudad de Villa Montes, fue fundada en el año 2021, teniendo como inversionista y propietario al Sr. Gody Condori Choque. Esta empresa se basa en la venta de libros, brindando a la clientela una variedad de categorías de libros, obras literarias, y más.</p>
            <p>La necesidad de manejar la información de sus productos de manera eficiente llevó a la empresa a mejorar sus sistemas administrativos y laborales. Su objetivo principal es ser una de las primeras opciones para el cliente consumidor en la ciudad de Villa Montes.</p>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-2">Ubicación</h3>
            <p>La microempresa “Casa del Libro” se encuentra ubicada en el municipio de Villa Montes, provincia Gran Chaco, departamento de Tarija, Bolivia.</p>
            <p><strong>Dirección de oficina:</strong> Av. Méndez Arcos Esq. Calle Ismael Montes</p>
        </div>
    </div>
</div>
@endsection
