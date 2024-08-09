
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

                @component('admin.layouts.components.form.input_email')
                    @slot('type', $type)
                    @slot('name', 'email')
                @endcomponent

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'code')
                    @slot('tooltip', 'Usado no gerador de XPROMO.')
                @endcomponent

                <div class="form-group">
                    <label>{{ modelAttribute($type, 'roles') }}</label>
                    @foreach ($roles as $role)
                        <div class="custom-control custom-checkbox align-items-center">
                            {{ html()->checkbox('roles[]', $instance->roles->find($role->getKey()), $role->getKey())->id('roles_' . $role->getKey())->class('custom-control-input') }}

                            {{ html()->label($role->name, 'roles_' . $role->getKey())->class('custom-control-label text-small') }}
                        </div>
                    @endforeach
                </div>
            @endcomponent

            @component('admin.layouts.components.card')
                @slot('title', $isUpdate ? 'Alterar a senha' : 'Cadastro de senha')

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

    @php(html()->endModel())

@endsection
