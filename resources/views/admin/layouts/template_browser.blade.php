@extends('admin.layouts.base')

@section('body-class', 'browser')

@section('body')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
@stop
