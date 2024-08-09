@php($simple = $simple ?? false)
@php($size = $size ?? 10)
<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $name), $name) }}
    {{ html()->multiselect($name . '[]', $options, isset($value) ? $value : null)
        ->id($name)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attributeIf($required ?? false, 'required')
        ->attributeIf(isset($readonly), 'readonly') 
        ->attribute('size', $size)
        }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}

    @if(!$simple)
        @push('scripts')
            <script>
                $(function() {
                    var $field = $('#{{ $name }}');
                    $field.select2({{ isset($tags) && $tags ? '{ tags: true }' : '' }});
                    $field.on('select2:close', function () {
                        $field.trigger('blur');
                    });
                });
            </script>
        @endpush
    @endif
</div>
