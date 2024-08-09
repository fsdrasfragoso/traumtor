<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    {!! $label_after ?? '' !!}
    {{ html()->textarea($name, isset($value) ? $value : null)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->data('hidden-buttons', 'cmdHeading cmdImage cmdList cmdListO cmdCode cmdQuote')
        ->attributeIf($required ?? false, 'required')
        ->attribute('rows', 10)
        ->attributeIf($disabled ?? false, 'disabled') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>

@if(!isset($disabled) || !$disabled)
    @push('scripts')
        <script>
            $(function() {
                $("#{{ $name }}").markdown({
                    autofocus:false,
                    savable:false,
                    fullscreen: false,
                })

                $('.btn-primary[data-provider=bootstrap-markdown]').click(function () {
                    let current_text = $("#{{ $name }}").val();
                    $("#{{ $name }}").val(current_text.replace(/(?:\r|\n|\r\n)/g, '  \n'));

                    if ($('.md-preview').length) {
                        $("#{{ $name }}").val(current_text.replace(/(?:\s\s\n)/g, '\n'))
                    }
                });
            });
        </script>
    @endpush
@endif
