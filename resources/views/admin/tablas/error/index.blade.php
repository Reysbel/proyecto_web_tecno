@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>productos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lista de Usuarios</div>
            </div>
        </div>
        <section id="wsus__404">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-10 col-lg-8 col-xxl-5 m-auto">
                        <div class="wsus__404_text">
                            <h2>404</h2>
                            <h4><span>¡¡¡Uy!!! Algo Salió Mal Aquí</h4>
                            <p>Puede haber una falta de ortografía en la URL ingresada,
                             o la página que está buscando ya no puede existe</p>
                            <a href="{{ route('admin.dashboard') }}" class="common_btn">Regresa Al Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
