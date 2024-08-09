@extends('frontend.layouts.base')

@section('body-class', 'checkout')

@section('body')
    <div id="wrapper" class="wrapper">

        @include('checkout.layouts.partials.header')

        <main id="main" class="main">

            <div id="main-content" class="main__content">
                <div class="animated fadeIn">
                    @yield('content')
                </div>

                @if(request()->pjax())
                    @include('frontend.layouts.partials.scripts')
                    @stack('modals')
                @endif

            </div>

        </main>

        @include('checkout.layouts.partials.footer')
        @include('frontend.layouts.partials.auth-modal')

    </div>
@stop
