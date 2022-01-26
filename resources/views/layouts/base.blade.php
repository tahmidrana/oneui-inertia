<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('title', 'Home')</title>
    <!--<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />-->

    <?php
        /*header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');*/
    ?>

    <meta name="description" content="PHWC Management Platform">
    <meta name="author" content="Appinion BD Ltd">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('theme/media/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('theme/media/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('theme/media/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('theme/media/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('theme/media/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('theme/media/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('theme/media/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('theme/media/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('theme/media/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('theme/media/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('theme/media/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('theme/media/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/media/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('theme/media/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('theme/media/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts and Styles -->
    @yield('datatable_styles')
    @yield('styles_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('theme/css/oneui.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/app.css') }}">

    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
    {{-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/amethyst.css') }}"> --}}
    @yield('styles')

    <script src="{{ asset('js/alpine-2.8.1.min.js') }}" defer></script>


    <!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    {{-- <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow"> --}}

        {{-- <x-right-sidebar /> --}}

        <!-- Sidebar -->
        <x-left-nav />
        <!-- END Sidebar -->

        <!-- Header -->
        <x-header />
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero -->
            @yield('breadcrumb')
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row font-size-sm">
                    <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                        Developed {{-- <i class="fa fa-heart text-danger"></i> --}} by <a class="font-w600" href="https://appinionbd.com" target="_blank">Appinion BD Ltd</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                        <a class="font-w600" href="#" target="_blank">{{ env('APP_NAME') }}</a> &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->

        @if(App::environment() !== 'production')
            <div id="testflag"
                style="position: fixed; top: 0px; right: 0px;
                        width: 305px; height: 305px;
                        background: url({{ asset('img/test-mode.png') }}) no-repeat 65% 65%;
                        z-index: 10000; pointer-events: none;
                        opacity: 0.3; filter: alpha(opacity=30);">
            </div>
        @endif
    </div>


    <!-- OneUI Core JS -->
    <script src="{{ asset('theme/js/oneui.core.min.js') }}"></script>
    <script src="{{ asset('theme/js/oneui.app.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/js/pages/be_pages_dashboard.min.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            //
        });

        function convert24To12Format (time24) {
            const [sHours, minutes] = time24.match(/([0-9]{1,2}):([0-9]{2})/).slice(1);
            const period = +sHours < 12 ? 'AM' : 'PM';
            const hours = +sHours % 12 || 12;
            return `${hours}:${minutes} ${period}`;
        }

        function confirmDelete(formId='deleteForm') {
            if(confirm('Are you sure want to delete?')) {
                $('#'+formId).submit();
            } else {
                return;
            }
        }

    </script>

    @yield('datatable_scripts')
    @yield('scripts')
    @stack('scripts')
    @yield('scripts_after')
</body>
</html>
