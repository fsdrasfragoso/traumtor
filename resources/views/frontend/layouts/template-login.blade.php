@extends('frontend.layouts.base')

@section('body-class', 'login')

@section('body')
    <main class="auth-container">
        {{-- <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4"> --}}
                    <div class="auth-card">
                        @include('frontend.layouts.partials.header-login')

                    {{-- <main id="main" class="main">
                        <div id="main-content" class="main__content"> --}}
                            @yield('content')
                        {{-- </div>
                    </main> --}}
                    </div>
                    @include('frontend.layouts.partials.footer-login')
                {{-- </div>
            </div>
        </div> --}}
    </main>
@stop
