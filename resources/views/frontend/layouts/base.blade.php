<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-pjax-version" content="@yield('body-class'){{ mix('js/frontend/app.js') . mix('css/frontend/app.css') }}">
    <meta name="author" content="Badusoft">
    <meta name="theme-color" content="#2E2E2E">
    <meta name="google" content="notranslate">
    <meta name="bearer-token" content="{{ getTokenFromHeaderRequest() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- seo tags --}}
    <title>@yield('title')</title>
    @include('frontend.layouts.partials.head-meta')
    {{-- stylesheets --}}
    <link rel="stylesheet" href="{{ mix('css/frontend/app.css') }}">
    @stack('styles')

</head>
<body id="body" class="@yield('body-class')">

    @yield('body')

    {{-- modals --}}
    @stack('modals')

    {{-- scripts --}}
    @stack('pre-scripts')
    <script src="{{ mix('js/frontend/app.js') }}"></script>
    @include('frontend.layouts.partials.scripts')
</body>
</html>
