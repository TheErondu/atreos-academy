<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>

    <!-- Prevent the site from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('vendor/spinkit.css') }}" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('css/material-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('css/preloader.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="layout-boxed ">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

    <!-- Drawer Layout -->
@auth


    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div style="" class="mdk-drawer-layout__content page-content">

            <!-- Header -->
            @auth
                @include('layouts.admin-header')
            @endauth

            <!-- // END Header -->

            <!-- BEFORE Page Content -->

            <!-- // END BEFORE Page Content -->
            @include('layouts.session-messages')
            @stack('styles')
            <hr>
            @yield('content')

        </div>

        <!-- // END drawer-layout__content -->

        <!-- Drawer -->
        @auth
            @include('layouts.sidebar')
        @endauth
        <!-- // END Drawer -->

    </div>
    @endauth

    @guest
        @yield('content')
    @endguest
    <!-- // END Drawer Layout -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('vendor/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('vendor/material-design-kit.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Preloader -->
    <script src="{{ asset('js/preloader.js') }}"></script>
    <!-- Global Settings -->
    <script src="{{ asset('js/settings.js') }}"></script>

    <!-- Moment.js -->
    <script src="{{ asset('vendor/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/moment-range.js') }}"></script>
    @stack('scripts')

</body>

</html>
