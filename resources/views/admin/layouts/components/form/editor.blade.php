<div class="form-group ckeditors {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    {!! $label_after ?? '' !!}
    {{ html()->textarea($name, isset($value) ? $value : null)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attributeIf($required ?? false, 'required')
        ->attribute('rows', 10) }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>

@pushonce('scripts:templates')
    @include('admin.layouts.partials.editor-templates')
@endpushonce

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

            window.editor_{{ $name }} = CKEDITOR.replace('{{ $name }}', ckeditorConfig);
        });
    </script>
@endpush
