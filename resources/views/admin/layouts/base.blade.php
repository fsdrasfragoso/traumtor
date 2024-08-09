<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-pjax-version" content="@yield('body-class'){{ mix('js/admin/app.js') . mix('css/admin/app.css') }}">
    <meta name="author" content="Badusoft">
    <meta name="google" content="notranslate">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    {{-- seo tags --}}
    <title>@yield('title')</title>
    {{-- stylesheets --}}
    <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
    @yield('styles')
    @stack('styles')
</head>
<body class="@yield('body-class')">
    @yield('body')

    {{-- scripts --}}
    @stack('pre-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.4/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.4/lang/pt-br.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js"></script>
    <script src="{{ mix('js/admin/app.js') }}"></script>
    @include('admin.layouts.partials.scripts')
</body>
</html>
