<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Página de inicio</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/assets/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('customer/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />


</head>
<body>
    <!-- Barra de navegación-->
    @include('cliente.layouts.navbar')
    <!-- Barra de Encabezado -->
    

    <!-- Contenido -->
    @yield('content')

    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('customer/js/scripts.js') }}"></script>
</body>
</html>
