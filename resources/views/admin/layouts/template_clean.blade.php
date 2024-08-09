@extends('admin.layouts.base')

@section('body-class', 'clean')
@section('body')
    <main class="main h-100 w-100">
        @yield('content')
    </main>
@stop
