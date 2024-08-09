@section('title', title(modelAction($type, 'show')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('breadcrumbs', app('breadcrumbs'))
        @slot('aside')
            <div class="btn-group">
                @if($instance->deleted_at)
                    @can('restore', $instance)
                        <a href="{{ $instance->route('restore') }}" class="btn btn-warning" data-toggle="tooltip" title="Restaurar" data-method="PUT" data-method-pjax="true" data-confirm="{{ modelAction($type, 'confirmation.restore') }}">
                            {{ modelAction($type, 'restore') }}
                        </a>
                    @endcan
                @else
                    @can('delete', $instance)
                        <a href="{{ $instance->route('delete') }}" class="btn btn-danger" data-toggle="tooltip" title="Excluir" data-method="DELETE" data-method-pjax="true" data-confirm="{{ modelAction($type, 'confirmation.delete') }}">
                            {{ modelAction($type, 'delete') }}
                        </a>
                    @endcan
                @endif

                @can('create', $type)
                    <a href="{{ $instance->route('create') }}" class="btn btn-secondary">
                        {{ modelAction($type, 'create') }}
                    </a>
                @endcan
            </div>
        @endslot
        @yield('header')
    @endcomponent

    @yield('info')

@stop
