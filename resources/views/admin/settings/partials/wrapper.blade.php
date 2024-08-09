
@section('title', title(__('Configurações')))

@section('content')

    @component('admin.layouts.components.header')
        @slot('title', __('Configurações'))
    @endcomponent

    <div class="row">

        <div class="col-md-4 col-xl-3">
            <div class="card">
                <div class="list-group list-group-flush" role="tablist">
                  

                    <a href="{{ $instance->route('blocks') }}" class="list-group-item list-group-item-action {{ request()->route()->getName() == 'web.admin.settings.blocks' ? 'active' : '' }}">
                        {{ __('E-mails bloqueados') }}
                    </a>

                    <a href="{{ $instance->route('features') }}" class="list-group-item list-group-item-action {{ request()->route()->getName() == 'web.admin.settings.features' ? 'active' : '' }}">
                        {{ __('Features') }}
                    </a>

                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            @yield('form')
        </div>
    </div>
@stop
