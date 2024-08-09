@extends('admin.layouts.template')

@section('title', title(modelAction($type, 'show')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('breadcrumbs', app('breadcrumbs'))
        @slot('aside')
            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Ações</button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ $instance->route('login') }}" class="dropdown-item" target="_blank">
                        <i class="fal fa-sign-in mr-2"></i>{{ modelAction($type, 'login') }}
                    </a>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-body text-center">
                    @php($avatar = $instance->getFirstMedia('avatar'))
                    @php($avatar_url = $avatar ? $avatar->getUrl() : 'https://www.gravatar.com/avatar/' . md5($instance->email) . '?d=mp')
                    <img src="{{ $avatar_url }}" alt="{{ $instance->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                    <br>
                    <a href="{{ $instance->route('edit') }}" class="btn btn-primary mb-2">Editar</a>

                    <h5 class="card-title mb-0">{{ $instance->name }}</h5>
                    <div class="text-muted mb-0">{{ $instance->cnpj }}</div>
                    <div class="text-muted mb-0">{{ $instance->email }}</div>
                    <div class="text-muted mb-0"><strong>Data de cadastro:</strong> {{ $instance->created_at->format('d/m/Y') }}</div>
                    <br>

                    <div class="mb-1">
                        {{ html()->modelForm($instance, 'PUT', $instance->route('change'))->open() }}
                        <input type="hidden" name="status" value="{{  $instance->status == \App\Models\Footballer::STATUS_BLOCKED ? \App\Models\Footballer::STATUS_ACTIVE : \App\Models\Footballer::STATUS_BLOCKED }}"/>

                        <button type="submit" class="btn {{ $instance->status == \App\Models\Footballer::STATUS_BLOCKED ? 'btn-warning' : 'btn-secondary' }} btn-sm"><i class="fal {{ $instance->status == \App\Models\Footballer::STATUS_BLOCKED ? 'fa-lock-open' : 'fa-lock' }}"></i> {{ $instance->status == \App\Models\Footballer::STATUS_BLOCKED ? 'Liberar acesso' : 'Bloquear acesso' }}</button>
                        {{ html()->closeModelForm() }}
                    </div>
                </div>

                <div class="card">
                    <div class="list-group list-group-flush" role="tablist">
                        <button type="button" class="btn btn-link list-group-item list-group-item-action fields-toggle active" data-toggle="fields" data-target="sales-fields">Vendas</button>
                        <button type="button" class="btn btn-link list-group-item list-group-item-action fields-toggle" data-toggle="fields" data-target="personal-fields">Dados básicos</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            <div id="sales-fields" class="fields collapse show">
                
            </div>

            <div id="personal-fields" class="fields collapse">
                @component('admin.layouts.components.card_clean')
                    @slot('title', __('Dados básicos'))
                    <div class="table-responsive">
                        <table class="table table-striped footballer-data">
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'name') }}</strong></td>
                                <td>
                                    {{ $instance->name }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="name">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'email') }}</strong></td>
                                <td>
                                    {{ $instance->email }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="email">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                @endcomponent

                @component('admin.layouts.components.card_clean')
                    @slot('title', __('Endereço'))

                    <div class="table-responsive">
                        <table class="table table-striped footballer-data">
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'zip_code') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.zip_code') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="zip_code">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'street') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.street') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="street">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'number') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.number') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="number">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'neighborhood') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.neighborhood') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="neighborhood">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'complement') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.complement') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="complement">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'city') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.city') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="city">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="shrink"><strong>{{ modelAttribute($type, 'state') }}</strong></td>
                                <td>
                                    {{ data_get($instance, 'address.state') }}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="mr-2 message"></span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="update-request" value="state">
                                        <label class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                @endcomponent
            </div>
        </div>

    </div>

@stop

@push('scripts')
    <script>
        $(function() {
            function fieldsToggle(target, active) {
				$('[data-toggle=fields]').removeClass('active');
				$('[data-toggle=fields][data-target='+target+']').addClass('active');

				if(active){
                    $('[data-toggle=fields][data-target='+active+']').addClass('active');
                }

				$('.fields:not(#'+target+')').collapse('hide');
				$('#'+target).collapse('show');
			}

        	$('[data-toggle=fields]').on('click', function (e) {
                fieldsToggle($(e.target).data('target'), $(e.target).data('active'));
			});
        });
    </script>
@endpush
