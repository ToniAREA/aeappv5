<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Bespoke marine electronics services for yachts." /> <!-- Completa con una descripción relevante -->
    <meta name="author" content="Area Electronica" /> <!-- Completa con el nombre del autor o empresa -->
    <title>Area Electronica, bespoke marine electronics for yachts.</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet" />
    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    @include('partials.header')

    @yield('content')

    @include('partials.footer')
    @yield('scripts')
    <!-- Inclusión de Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Usar la versión estable -->
</body>

</html>