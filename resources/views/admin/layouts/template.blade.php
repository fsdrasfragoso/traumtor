@extends('admin.layouts.base')

@section('body')
    <div class="wrapper">
        @include('admin.layouts.partials.sidebar')
        <div class="main">
            @include('admin.layouts.partials.navbar')

            <main id="main-content" class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>

                @if(request()->pjax())
                    @include('admin.layouts.partials.scripts')
                @endif
            </main>
        </div>
    </div>
@stop
