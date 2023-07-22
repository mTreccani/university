@props(['showNavbar' => false, 'scripts' => []])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="icon" href="{{ asset('favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'University') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Avenir:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/components/locale.js', ...$scripts])
</head>
<body>
    <div class="h-100 w-100 d-flex flex-row">
        <div class="d-flex w-100 h-100 flex-column">
            @if($showNavbar)
                <x-navbar></x-navbar>
            @endif

            <div class="w-100 px-4 sticky-top bg-body">
                @yield('sticky-top')
            </div>
            <div class="p-4 w-100 h-100 overflow-auto">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
