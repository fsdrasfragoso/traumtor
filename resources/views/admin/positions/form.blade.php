
@section('form')

    @php(html()->model($instance))

    <div class="row">
        <div class="col-lg-8 col-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Dados básicos'))

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'name')
                    @slot('required', true)
                @endcomponent

                @component('admin.layouts.components.form.editor')
                    @slot('type', $type)
                    @slot('name', 'description')
                @endcomponent

                @component('admin.layouts.components.form.select')
                    @slot('type', $type)
                    @slot('name', 'modality_id')
                    @slot('options', $modalities)                    
                    @slot('required', true)
                @endcomponent
                                
            @endcomponent

            
        </div>
        

        <div class="col-12">
            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
            </div>
        </div>
    </div>

    @php(html()->endModel())

@endsection
