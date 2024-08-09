@section('title', title(modelAction($type, 'label')))

@section('content')

    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('breadcrumbs', app('breadcrumbs'))
        @slot('aside')
            <div class="btn-group">
                @if ($instance->hasRoute('export'))
                    @can('export', $instance)
                    <a href="{{ $instance->route('export') }}?{{ http_build_query(request()->only('q', 'order')) }}" class="btn btn-dark">
                        {{ modelAction($type, 'export') }}
                    </a>
                    @endcan
                @endif
                @if ($instance->hasRoute('create'))
                    <a href="{{ $instance->route('create') }}" data-pjax class="btn btn-secondary">
                        {{ modelAction($type, 'create') }}
                    </a>
                @endcan
                @yield('header-actions')
            </div>
        @endslot
        @yield('header')
    @endcomponent

    <div class="row">

        @hasSection('filters')
            <div class="col-lg-12">
                @component('admin.layouts.components.card_filter')
                    {{ html()->form('GET', $instance->route('index'))->data('pjax', true)->open() }}
                    @yield('filters')
                    @include('admin.layouts.components.filters.buttons')

                    {{ html()->form()->close() }}
                @endcomponent
            </div>
        @endif

        <div class="col-lg-12">
            @component('admin.layouts.components.card_clean')
                @slot('title', modelAction($type, 'index'))
                @slot('class', 'mb-4')

                @slot('actions')
                    @if(get_class($resources) !== 'Illuminate\Pagination\Paginator' && $resources->total() > 0)
                        <span class="text-muted">{{ $resources->total() }} {{ $resources->total() > 1 ? __('registros') : __('registro') }}</span>
                    @endif
                    @if(isset($totalAmount) && $totalAmount > 0)
                        |
                        <span class="text-muted">{{ __('Valor total: ') . moneyFormat($totalAmount) }}</span>
                    @endif

                    @php($additionalActionsView = 'admin.'.$instance->getTable().'.partials.additional_actions')
                    @includeWhen(View::exists($additionalActionsView), $additionalActionsView)
                @endslot

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>                            
                            @foreach ($instance->getAdminColumns() as $column)
                                <th {!! $instance->getAdminColumnAttributes($loop->index, $column) !!}>
                                    @if(in_array($column, $instance->getOrderColumns()))
                                        @component('admin.layouts.components.link_order')
                                            @slot('column', $column)
                                            {{ modelAttribute($type, $column) }}
                                        @endcomponent
                                    @else
                                        {{ modelAttribute($type, $column) }}
                                    @endif
                                </th>
                            @endforeach
                            <th class="shrink"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($resources as $resource)
                            <tr {!! $instance->getAdminRowAttributes($loop->index) !!}>
                               
                                @foreach ($resource->getAdminColumns() as $column)
                                    <td {!! $resource->getAdminColumnAttributes($loop->index, $column) !!}>
                                        {!! $resource->getAdminColumn($column) !!}
                                    </td>
                                @endforeach
                                    
                                <td class="shrink text-right">

                                    {!! $resource->getAdminActions() !!}

                                    @if(!method_exists($resource, 'withDefaultActions') || $resource->withDefaultActions())
                                        @can('view', $resource)
                                            <a href="{{ $resource->route('show') }}" data-pjax data-toggle="tooltip" title="Visualizar" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        @can('update', $resource)
                                            <a href="{{ $resource->route('edit') }}" data-pjax data-toggle="tooltip" title="Editar" class="btn btn-previous btn-sm"><i class="fal fa-pen"></i></a>
                                        @endcan
                                        @can('delete', $resource)
                                            <a href="{{ $resource->route('delete') }}" data-toggle="tooltip" title="Excluir" data-method="DELETE" data-method-pjax="true" data-confirm="{{ modelAction($type, 'confirmation.delete') }}" class="btn btn-danger btn-sm"><i class="fal fa-trash-alt"></i></a>
                                        @endcan
                                    @endif

                                    @if($resource->getAdminDropdownActions())
                                        <div class="d-inline">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="fal fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                {!! $resource->getAdminDropdownActions() !!}
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($instance->getAdminColumns()) + 1 }}">
                                    {{ trans('pagination.no_records') }}
                                </td>
                            </tr>
                        @endforelse  
                        </tbody>
                    </table>
                </div>

            @endcomponent

            @if($pagination = $resources->appends(request()->except(['_pjax']))->links('vendor.pagination.bootstrap-4'))
                {!! $pagination !!}
            @endif

            @yield('after-table')
        </div>
    </div>
@stop
