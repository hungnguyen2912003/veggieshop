<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets/client/img/favicon.png') }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/toastr.min.css') }}">
</head>

<body>
<!-- Body main wrapper start -->
<div class="body-wrapper">

    <!-- HEADER AREA START (header-5) -->
    @include('client.partials.header')
    <!-- HEADER AREA END -->

    <!-- BREADCRUMB AREA START -->
    @include('client.partials.breadcrumb')
    <!-- BREADCRUMB AREA END -->

    <!-- PAGE CONTENT START -->
    @yield('content')
    <!-- PAGE CONTENT END -->

    <!-- FOOTER AREA START -->
    @include('client.partials.footer')
    <!-- FOOTER AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="{{ asset('assets/client/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/client/js/main.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/client/js/custom.js') }}"></script>

    <script src={{ asset('assets/client/js/toastr.min.js') }}></script>
</body>
</html>