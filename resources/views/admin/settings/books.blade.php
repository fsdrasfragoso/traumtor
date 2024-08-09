@extends('admin.layouts.template')

@section('form')
    {{ html()->modelForm($instance, 'PUT', $instance->route('books'))->acceptsFiles(true)->attribute('data-validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->open() }}

    @component('admin.layouts.components.card')
        @slot('title', __('Envio de e-mails'))

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="hidden" name="books[enabled]" value="0" />
                        {{ html()->checkbox('books[enabled]', settings('books.enabled', false), 1)->id('books[enabled]')->class(['custom-control-input']) }}
                        {{ html()->label(modelAttribute($type, 'books.enabled'), 'books[enabled]')->class('custom-control-label') }}
                    </div>
                    @include('frontend.layouts.components.form.errors', ['name' => 'books.enabled'])
                </div>
            </div>
        </div>
    @endcomponent

    @component('admin.layouts.components.card')
        @slot('title', __('Confirmação do pedido'))

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ html()->label(modelAttribute($type, 'books.confirmed_page'), 'books.confirmed_page') }}
                    {{ html()->textarea('books[confirmed_page]', settings('books.confirmed_page'))
                        ->class(['form-control', 'is-invalid' => $errors->has('books[confirmed_page]')])
                        ->attribute('rows', $rows ?? 5)
                    }}
                    @php($confirmeds = 'books[confirmed_page]')
                    @include('admin.layouts.components.form.errors', ['name' => $confirmeds])
                </div>

                <small class="form-text text-muted">
                    Variáveis disponíveis:
                    <ul class="mb-0">
                        <li><strong>%%FIRST_NAME%%</strong> (Nome do futebolista)</li>
                        <li><strong>%%LAST_NAME%%</strong> (Sobrenome do futebolista)</li>
                        <li><strong>%%NAME%%</strong> (Nome completo do futebolista)</li>
                        <li><strong>%%BOOK_NAME%%</strong> (Nome do livro)</li>
                        <hr class="my-1 p-0" />
                        <li><strong>%%STREET%%</strong> (Rua do endereço do futebolista)</li>
                        <li><strong>%%NUMBER%%</strong> (Número do endereço futebolista)</li>
                        <li><strong>%%COMPLEMENT%%</strong> (Complemento do endereço do futebolista)</li>
                        <li><strong>%%NEIGHBORHOOD%%</strong> (Bairro do endereço do futebolista)</li>
                        <li><strong>%%ZIP_CODE%%</strong> (CEP do endereço do futebolista)</li>
                        <li><strong>%%CITY%%</strong> (Cidade do endereço do futebolista)</li>
                        <li><strong>%%STATE%%</strong> (Estado do endereço do futebolista)</li>
                    </ul>
                </small>
            </div>
        </div>
    @endcomponent

    @component('admin.layouts.components.card')
        @slot('title', __('Confirmação do pagamento'))

        <div class="form-group">
            {{ html()->label(modelAttribute($type, 'books.payment_confirmation_page'), 'books.payment_confirmation_page') }}
            {{ html()->textarea('books[payment_confirmation_page]', settings('books.payment_confirmation_page'))
                ->class(['form-control', 'is-invalid' => $errors->has('books[payment_confirmation_page]')])
                ->attribute('rows', $rows ?? 5)
            }}
            @php($paymentConfirmation = 'books[payment_confirmation_page]')
            @include('admin.layouts.components.form.errors', ['name' => $paymentConfirmation])
        </div>

        <small class="form-text text-muted">
            Variáveis disponíveis:
            <ul class="mb-0">
                <li><strong>%%FIRST_NAME%%</strong> (Nome do futebolista)</li>
                <li><strong>%%LAST_NAME%%</strong> (Sobrenome do futebolista)</li>
                <li><strong>%%NAME%%</strong> (Nome completo do futebolista)</li>
                <li><strong>%%BOOK_NAME%%</strong> (Nome do livro)</li>
                <hr class="my-1 p-0" />
                <li><strong>%%STREET%%</strong> (Rua do endereço do futebolista)</li>
                <li><strong>%%NUMBER%%</strong> (Número do endereço futebolista)</li>
                <li><strong>%%COMPLEMENT%%</strong> (Complemento do endereço do futebolista)</li>
                <li><strong>%%NEIGHBORHOOD%%</strong> (Bairro do endereço do futebolista)</li>
                <li><strong>%%ZIP_CODE%%</strong> (CEP do endereço do futebolista)</li>
                <li><strong>%%CITY%%</strong> (Cidade do endereço do futebolista)</li>
                <li><strong>%%STATE%%</strong> (Estado do endereço do futebolista)</li>
            </ul>
        </small>
    @endcomponent

    <div class="form-group">
        {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
    </div>

    {{ html()->closeModelForm() }}

@stop

@include('admin.settings.partials.wrapper')

@push('scripts')
    <script>
        $(function() {

            var ckeditorConfig = {
                @if(isset($basic) && $basic)
                    toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] }
                    ],
                @endif
                removeButtons: '',
                height: {{ $height ?? 500 }},
                extraPlugins: 'justify,colorbutton,pastefromword,uploadimage,image2,codemirror,template,videoembed,ckawesome',
                allowedContent: {
                    $1: {
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    }
                },
                disallowedContent: 'span{font-family,font-size};' +
                    '*{margin};*{font*};' +
                    'table[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'td[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'tr[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'col[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign]',

                filebrowserImageBrowseUrl: '{{ route('web.admin.gallery.browser') }}',

                imageUploadUrl: '{{ route('web.admin.gallery.fileupload') }}',

                stylesSet: [
                    { name: 'Legenda de imagem', element: 'span', attributes: { 'class': 'figcaption' } },
                    { name: 'Header tabela', element: 'td', attributes: { 'class': 'table-header' } },
                    { name: 'Remover quebra', element: 'td', attributes: { 'class': 'nowrap' } },
                ],

                contentsCss: [ CKEDITOR.basePath + 'contents.css', '/css/admin/widgetstyles.css', '{{ mix("/css/frontend/app-ckeditor.css") }}' ],

                image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right'],
                image2_disableResizer: true,
                codemirror: {
                    theme: 'monokai',
                    enableCodeFormatting: true,
                    autoFormatOnStart: true,
                    autoFormatOnModeChange: true
                },
                template: {
                    templates: [
                        {
                            name: 'cta-inline',
                            label: 'CTA',
                            template: $('#cta-inline-template').html()
                        },
                        {
                            name: 'cta-block',
                            label: 'CTA Bloco',
                            template: $('#cta-block-template').html()
                        },
                        {
                            name: 'block-editor-note',
                            label: 'Nota do Editor',
                            template: $('#block-editor-note-template').html()
                        },
                        {
                            name: 'block-podcasts',
                            label: 'Bloco podcasts',
                            template: $('#block-podcasts').html()
                        }
                    ]
                },
                fontawesomePath : '/css/admin/app.css'
            };

            CKEDITOR.plugins.addExternal('codemirror', '/js/ckeditor/plugins/codemirror/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('template', '/js/ckeditor/plugins/template/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('videoembed', '/js/ckeditor/plugins/videoembed/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('ckawesome', '/js/ckeditor/plugins/ckawesome/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('image2', '/js/ckeditor/plugins/image2/', 'plugin.js' );

            CKEDITOR.replace('{{ $confirmeds }}', ckeditorConfig);
            CKEDITOR.replace('{{ $paymentConfirmation }}', ckeditorConfig);
        });
    </script>
@endpush
