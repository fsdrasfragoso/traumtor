@section('form')

    @php(html()->model($instance))

    <div class="row">
        <div class="col-lg-8">
            @component('admin.layouts.components.card')
                @slot('title', __('Dia da Partida'))

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'name')
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
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'street')
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'number')
                            @slot('attributes', [
                                'maxlength' => 9,
                            ])
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'neighborhood')
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'complement')
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('admin.layouts.components.form.select')
                            @slot('type', $type)
                            @slot('name', 'state')
                            @slot('options', $states)
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'city')
                        @endcomponent
                    </div>
                </div>
            @endcomponent
        </div>

        <div class="col-lg-4">
            @component('admin.layouts.components.card')
                @slot('title', __('Additional Information'))

                @component('admin.layouts.components.form.select')
                    @slot('type', $type)
                    @slot('name', 'captain_id')
                    @slot('options', $footballers)
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.multiselect')
                    @slot('type', $type)
                    @slot('name', 'footballers')
                    @slot('options', $footballers)
                    @slot('value', old('footballers', $instance->footballers ? $instance->footballers->pluck('id') : null))
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
