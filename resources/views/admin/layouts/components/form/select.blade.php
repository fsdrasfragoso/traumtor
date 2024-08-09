@php($simple = $simple ?? true)
<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $class ?? '' }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}

    @if(isset($tooltip))
        @php($tooltip_class = $tooltip_class ?? 'fa fa-question-circle')
        {{
            html()->span()
            ->addClass($tooltip_class)
            ->attribute('data-toggle', 'tooltip')
            ->attribute('data-title', $tooltip)
        }}
    @endif

    {{ html()->select($name, $options ?? null, $value ?? null)
        ->id($id ?? $name)
        ->placeholder($placeholder ?? null)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attributeIf($required ?? false, 'required')
        ->attributeIf(isset($tabindex), 'tabindex','-1')
        ->attributeIf(isset($tabindex), 'style','background: #EEE; 
  pointer-events: none;
  touch-action: none;')
        ->attributeIf(isset($aria_disabled), 'aria-disabled') }}
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
