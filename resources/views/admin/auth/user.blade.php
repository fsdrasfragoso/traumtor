@extends('admin.layouts.template')

@section('title', title(modelAction($type, 'edit')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', __('Perfil'))
    @endcomponent

    {{ html()->modelForm($instance, 'PUT', route('web.admin.auth.user.update'))->acceptsFiles(true)->attribute('data-validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->open() }}

        <div class="row">
            <div class="col-lg-12">
                @component('admin.layouts.components.card')
                    @slot('title', __('Dados básicos'))

                    @component('admin.layouts.components.form.input_text')
                        @slot('type', $type)
                        @slot('name', 'name')
                    @endcomponent

                    @component('admin.layouts.components.form.input_email')
                        @slot('type', $type)
                        @slot('name', 'email')
                    @endcomponent

                @endcomponent
                @component('admin.layouts.components.card')
                    @slot('title', __('Alterar a senha'))

                    @component('admin.layouts.components.form.input_password')
                        @slot('type', $type)
                        @slot('name', 'password')
                    @endcomponent

                    @component('admin.layouts.components.form.input_password')
                        @slot('type', $type)
                        @slot('name', 'password_confirmation')
                    @endcomponent

                @endcomponent

                <div class="form-group">
                    {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
                </div>
            </div>
        </div>

    {{ html()->closeModelForm() }}
@stop
