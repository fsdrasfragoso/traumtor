@php
    $address = $instance->address ?: new \App\Models\Address();
@endphp

@section('form')

    @php(html()->model($instance))

    <div class="row">
        <div class="col-lg-8">
            @component('admin.layouts.components.card')
                @slot('title', __('Dados básicos'))

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'name')
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.input_email')
                    @slot('type', $type)
                    @slot('name', 'email')
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'phone')
                    @slot('class', 'mask-phone')
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'document')
                    @slot('class', 'mask-cpf')
                    @slot('required', true)
                @endcomponent
            @endcomponent

            @component('admin.layouts.components.card')
                @slot('title', __('Endereço'))
                @slot('class', 'form-address')

                <div class="row">
                    <div class="col-lg-12">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'zip_code')
                            @slot('class', 'mask-zipcode')
                            @slot('value', $address->zip_code)
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'street')
                            @slot('value', $address->street)
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'number')
                            @slot('value', $address->number)
                            @slot('attributes', [
                                'maxlength' => 9,
                            ])
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'neighborhood')
                            @slot('value', $address->neighborhood)
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'complement')
                            @slot('value', $address->complement)
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('admin.layouts.components.form.select')
                            @slot('type', $type)
                            @slot('name', 'state')
                            @slot('options', \App\Models\Footballer::stateOptions())
                            @slot('value', $address->state)
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'city')
                            @slot('value', $address->city)
                        @endcomponent
                    </div>

                </div>

            @endcomponent

            @component('admin.layouts.components.card')
                @slot('title', $isUpdate ? __('Alteração de senha') : __('Cadastro de senha'))

                @if($isUpdate)
                    @slot('subtitle', '<span class="text-muted">Mantenha em branco para não atualizar</span>')
                @endif

                @component('admin.layouts.components.form.input_password')
                    @slot('type', $type)
                    @slot('name', 'password')
                @endcomponent

                @component('admin.layouts.components.form.input_password')
                    @slot('type', $type)
                    @slot('name', 'password_confirmation')
                @endcomponent
            @endcomponent

        </div>

        <div class="col-lg-4">
            @component('admin.layouts.components.card')
                @slot('title', __('Publicação'))

                @component('admin.layouts.components.form.select')
                    @slot('type', $type)
                    @slot('name', 'status')
                    @slot('options', \App\Models\Footballer::statusOptions())
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.multiselect')
                    @slot('type', $type)
                    @slot('name', 'modalities')
                    @slot('options', $modalities)
                    @slot('value', old('modalities', $instance->modalities ? $instance->modalities->pluck('id') : null))
                @endcomponent

                @component('admin.layouts.components.form.multiselect')
                    @slot('type', $type)
                    @slot('name', 'positions')
                    @slot('options', $positions)
                    @slot('value', old('positions', $instance->positions ? $instance->positions->pluck('id') : null))
                @endcomponent

                @component('admin.layouts.components.form.select')
                    @slot('type', $type)
                    @slot('name', 'dominant_foot')
                    @slot('options', \App\Models\Footballer::dominantFootOptions())
                    @slot('required', true)
                @endcomponent
                
                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'overall')
                    @slot('value',!empty($instance->overall) ? $instance->overall : '50')
                    @slot('required', true)
                @endcomponent

            @endcomponent
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
            </div>
        </div>
    </div>

    @php(html()->endModel())

@endsection

@if($isUpdate && !$address->confirmed_at)
    @push('scripts')
        <script>
            $(function() {
                $('#btn-confirm').click(function(e) {
                    e.preventDefault();

                    let url = '{{ route('web.admin.footballers.confirm_address', $instance->id) }}';
                    axios.get(url).then(function(result) {
                        $('.address-confirmation').addClass('d-none');
                        toastr.success('Endereço confirmado com sucesso.');
                    }).catch(function(e) {
                        toastr.error('Erro ao confirmar endereço.');
                    });
                });
            });
        </script>
    @endpush
@endif
