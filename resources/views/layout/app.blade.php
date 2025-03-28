<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Inclure le CSS de Bootstrap via CDN (version 5.3.3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Inclure les styles personnalisés -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles personnalisés pour ajuster l'apparence -->
    <style>
        .nav-tabs .nav-link {
            color: #000;
            border: 1px solid #dee2e6;
            border-bottom: none;
            border-radius: 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #6aa8e8;
            color: white;
            border-color: #6aa8e8;
        }

        .nav-tabs {
            border-bottom: 1px solid #6aa8e8;
        }

        .btn-danger {
            background-color: #ff0000;
            border-color: #ff0000;
        }

        .btn-warning {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #000;
        }

        .btn-success {
            background-color: #28a745;
            /* Vert similaire à la capture d'écran */
            border-color: #28a745;
        }

        .custom-input {
            border: 2px solid #000;
            /* Bordure plus épaisse */
            border-radius: 5px;
            padding: 8px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Inclure la barre de navigation -->
    @include('partials.navbar')

    <!-- Conteneur principal pour le contenu -->
    <div class="container mt-3">
        @yield('content')
    </div>

    <!-- Inclure le JS de Bootstrap (inclut Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Inclure les scripts personnalisés (si nécessaire) -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>