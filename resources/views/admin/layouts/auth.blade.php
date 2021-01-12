<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'IVR Pro'))</title>

        <!-- Styles -->

        <link href="{{ asset('assets/admin/css/basic.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/admin/css/common.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/admin/css/modal_contents.css') }}" rel="stylesheet">

        <!-- Customize Styles -->
         @yield('page_css')

        <!-- Scripts -->
        <script src="{{ asset('assets/admin/js/app.js') }}" defer></script>

        <script src="{{ asset('assets/admin/js/jquery.js') }}" defer></script>
        <script src="{{ asset('assets/admin/js/customize.js') }}" defer></script>
        <script src="{{ asset('assets/admin/js/autosize.js') }}" defer></script>
        <script src="{{ asset('assets/admin/js/modal_contents.js') }}" defer></script>
        <script src="{{ asset('assets/admin/js/jquery.fs.tipper.min.js') }}" defer></script>
        <script src="{{ asset('assets/admin/js/jquery.cookie.js') }}" defer></script>

        <!-- Customize Scripts -->
        @yield('page_js')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    </head>

    <body>
        @yield('content')
    </body>
</html>