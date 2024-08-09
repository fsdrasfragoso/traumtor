@inject('footballer_service', 'App\Services\FootballerService')

@extends('frontend.layouts.base')

@section('body')
    <main id="wrapper" class="wrapper">
        <main id="main" class="main">
            @include('frontend.layouts.partials.sidebar-footballer')

            <main id="main-content" class="main__content">

                @yield('content')

                @if(request()->pjax())
                    @stack('styles')
                    @include('frontend.layouts.partials.scripts')
                @endif

                @include('frontend.layouts.partials.toolbar')
            </main>
        </main>

        @include('frontend.layouts.partials.auth-modal')

    </main>
@stop
