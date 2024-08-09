@section('title', title(modelAction($type, 'edit')))

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
            </div>
        @endslot
        @yield('header')
    @endcomponent

    {{ html()->form('PUT', $instance->route('update'))->id('form-update')->acceptsFiles(true)->data('pjax', true)->data('validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->open() }}
        @yield('form')
    {{ html()->form()->close() }}
@stop
