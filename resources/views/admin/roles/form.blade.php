
@section('form')

    @php(html()->model($instance))

    <div class="row">
        <div class="col-lg-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Dados básicos'))

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'name')
                @endcomponent

                <div class="form-group">
                    <label>{{ modelAttribute($type, 'permissions') }}</label>
                    @php($permission_keys = array_slice(trans('permissions'), 1))
                    @php($category_size = intval(count($permission_keys) / 2))
                    @php($count_to_split = 0)

                    <div class="row">

                    @foreach ($permission_keys as $category_key => $category)
                    
                        @if($count_to_split % $category_size == 0) <div class="col-lg-6"> @endif

                        @foreach ($category as $permission_key => $permission_names)

                            @if ($permission_key === '_')

                                <h4 class="mt-3">{{ $permission_names }}</h4>

                            @else
                                @foreach ($permission_names as $item_type_key => $item_name)

                                    @php($permission = $permissions->where('name', $item_type_key.' '.$permission_key)->first())
                                    @if($permission)
                                        <div class="custom-control custom-checkbox align-items-center ml-3">
                                            {{ html()
                                                ->checkbox('permissions[]', $instance->permissions->find($permission->getKey()), $permission->getKey())
                                                ->checked($instance->permissions->find($permission->getKey()) ? true : false)
                                                ->id('permission_' . $permission->getKey())
                                                ->class('custom-control-input')
                                            }}

                                            {{ html()->label($item_name, 'permission_' . $permission->getKey())->class('custom-control-label text-small') }}
                                        </div>
                                    @endif

                                @endforeach 
                            @endif

                        @endforeach

                        @php(++$count_to_split)
                                
                        @if( ($count_to_split % $category_size == 0) || ($count_to_split % ($category_size * 2) == 0)) 
                            </div>
                        @endif
                        
                    @endforeach

                    </div>
                </div>
            @endcomponent

            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
            </div>
        </div>
    </div>

    @php(html()->endModel())

@endsection
