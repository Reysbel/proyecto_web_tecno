@extends('frontend.layouts.master')

@section('content')
    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Bienvenidos a <br />
                            <span class="text-primary">Casa del Libro</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Somos una empresa dedicada a la venta de libros en la ciudad de Villa Montes. Nuestro objetivo es ofrecer una amplia variedad de categorías de libros y obras literarias para todos los gustos.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                            data-bs-target="#pills-homes" type="button" role="tab"
                                            aria-controls="pills-homes" aria-selected="true">Iniciar Sesión</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                            data-bs-target="#pills-profiles" type="button" role="tab"
                                            aria-controls="pills-profiles" aria-selected="false">Crear una Cuenta</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent2">
                                    <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                        aria-labelledby="pills-home-tab2">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input id="email" type="email" name="email"
                                                    placeholder="Correo Electrónico" value="{{ old('email') }}"
                                                    class="form-control">
                                                <label class="form-label" for="form3Example3">Correo Electrónico</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <input id="password" type="password" name="password"
                                                    placeholder="Contraseña" class="form-control">
                                                <label class="form-label" for="form3Example4">Contraseña</label>
                                            </div>

                                            <!-- Checkbox -->
                                            <div class="form-check d-flex justify-content-center mb-4">
                                                <input id="remember_me" name="remember" class="form-check-input me-2"
                                                    type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault">Recuérdame</label>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                                Iniciar Sesión
                                            </button>

                                            <!-- Password Reset -->
                                            <div class="text-center">
                                                <a class="forget_p" href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                        aria-labelledby="pills-profile-tab2">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <!-- Name input -->
                                            <div class="form-outline mb-4">
                                                <input id="name" name="name" value="{{ old('name') }}"
                                                    type="name" placeholder="Nombre" class="form-control">
                                                <label class="form-label" for="form3Example1">Nombre</label>
                                            </div>
                                            <!-- Username input -->
                                            <div class="form-outline mb-4">
                                                <input id="username" name="username" value="{{ old('username') }}"
                                                    type="text" placeholder="Nombre de Usuario" class="form-control">
                                                <label class="form-label" for="form3Example2">Nombre de Usuario</label>
                                            </div>

                                            <!-- Phone input -->
                                            <div class="form-outline mb-4">
                                                <input id="phone" name="phone" value="{{ old('phone') }}"
                                                    type="text" placeholder="Teléfono" class="form-control">
                                                <label class="form-label" for="form3Example2">Teléfono</label>
                                            </div>
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input id="email" name="email" value="{{ old('email') }}"
                                                    type="email" placeholder="Correo Electrónico" class="form-control">
                                                <label class="form-label" for="form3Example3">Correo Electrónico</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <input id="password" name="password" value="{{ old('password') }}"
                                                    type="password" placeholder="Contraseña" class="form-control">
                                                <label class="form-label" for="form3Example4">Contraseña</label>
                                            </div>

                                            <!-- Confirm Password input -->
                                            <div class="form-outline mb-4">
                                                <input id="password_confirmation" name="password_confirmation"
                                                    type="password" placeholder="Confirmar Contraseña"
                                                    class="form-control">
                                                <label class="form-label" for="form3Example4">Confirmar Contraseña</label>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                                Registrarse
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>o regístrate con:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Casa del Libro 2024</p>
        </div>
    </footer>
@endsection
