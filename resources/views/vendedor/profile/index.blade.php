@extends('vendedor.layouts.master')

@section('content')
    <section class="section">
       
        <div class="section-body">
            <div class="row mt-sm-4>
              
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card profile-widget">
                    <form method="post" class="needs-validation" novalidate=""
                     action="{{ route('vendedor.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset(Auth::user()->image) }}"
                                class="rounded-circle profile-widget-picture">
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Imagen</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>Nombre y Apellido</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name }}" required="">
                                    <div class="invalid-feedback">
                                        Complete el campo con su Nombre y Apellido.
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}" required="">
                                    <div class="invalid-feedback">
                                        Complete el campo con su Correo Electrónico.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-7">
                <div class="card profile-widget">
                    
                    <form method="post" class="needs-validation" novalidate=""
                        action="{{ route('vendedor.password.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Contraseña Actual</label>
                                    <input type="password" class="form-control" name="current_password">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>Confirmar Contraseña</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Guardar Contraseña</button>
                </div>
                </form>

            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
