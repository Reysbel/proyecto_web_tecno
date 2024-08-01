<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LarBook</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</head>

<body class="day youth">
    <!-- Main Menu -->
    @include('frontend.layouts.menu')

    <!-- Botón desplegable para cambiar temas y accesibilidad -->
    <div class="dropdown my-3 d-flex justify-content">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fas fa-adjust"></i> Cambiar Tema y Accesibilidad
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#" onclick="toggleNightMode()"><i class="fas fa-sun"></i> Modo
                    Día/Noche</a></li>
            <li><a class="dropdown-item" href="#" onclick="setTheme('theme-kids')"><i class="fas fa-child"></i>
                    Tema para Niños</a></li>
            <li><a class="dropdown-item" href="#" onclick="setTheme('theme-youth')"><i
                        class="fas fa-user-graduate"></i> Tema para Jóvenes</a></li>
            <li><a class="dropdown-item" href="#" onclick="setTheme('theme-adult')"><i class="fas fa-user"></i>
                    Tema para Adultos</a></li>
            <li><a class="dropdown-item" href="#" onclick="setFontSize('font-small')"><i
                        class="fas fa-text-height"></i> Fuente Pequeña</a></li>
            <li><a class="dropdown-item" href="#" onclick="setFontSize('font-medium')"><i
                        class="fas fa-text-height"></i> Fuente Mediana</a></li>
            <li><a class="dropdown-item" href="#" onclick="setFontSize('font-large')"><i
                        class="fas fa-text-height"></i> Fuente Grande</a></li>
            <li><a class="dropdown-item" href="#" onclick="toggleHighContrast()"><i class="fas fa-adjust"></i>
                    Alto Contraste</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    @yield('content')

    <!-- jQuery and Bootstrap Bundle JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
    <!-- Custom JS -->
    <script>
        // Función para alternar entre modos día y noche
        function toggleNightMode() {
            document.body.classList.toggle('night-mode');
            document.body.classList.toggle('day-mode');
        }

        // Función para establecer el tema
        function setTheme(theme) {
            document.body.classList.remove('theme-kids', 'theme-youth', 'theme-adult');
            document.body.classList.add(theme);
        }

        // Función para establecer el tamaño de fuente
        function setFontSize(size) {
            document.body.classList.remove('font-small', 'font-medium', 'font-large');
            document.body.classList.add(size);
        }

        // Función para alternar alto contraste
        function toggleHighContrast() {
            document.body.classList.toggle('high-contrast');
        }

        // Detectar la hora del cliente y cambiar el modo automáticamente
        window.onload = function() {
            var hour = new Date().getHours();
            if (hour >= 18 || hour < 6) { // Cambiar a modo noche entre las 6 PM y las 6 AM
                document.body.classList.add('night-mode');
            } else {
                document.body.classList.add('day-mode');
            }
        }
    </script>

</body>

</html>
