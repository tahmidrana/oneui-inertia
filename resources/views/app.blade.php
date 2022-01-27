<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }} | @yield('title', 'Home')</title>

    <meta name="description" content="PHWC Management Platform">
    <meta name="author" content="Appinion BD Ltd">
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Theme CSS -->
    <link rel="stylesheet" id="css-main" href="{{ asset('theme/css/oneui.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <!-- OneUI Core JS -->
    <script src="{{ asset('theme/js/oneui.core.min.js') }}"></script>
    <script src="{{ asset('theme/js/oneui.app.min.js') }}"></script>

    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="">
    @inertia

    @env ('local')
        {{-- <script src="http://localhost:8000/js/bundle.js"></script> --}}
    @endenv

    @if(App::environment() !== 'production')
        <div id="testflag"
            style="position: fixed; top: 0px; right: 0px;
                    width: 305px; height: 305px;
                    background: url({{ asset('img/test-mode.png') }}) no-repeat 65% 65%;
                    z-index: 10000; pointer-events: none;
                    opacity: 0.3; filter: alpha(opacity=30);">
        </div>
    @endif
</body>
</html>
