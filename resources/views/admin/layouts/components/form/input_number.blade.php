@php($input = html()->number($name, $value ?? null)
    ->disabled($disabled ?? false)
    ->class(['form-control', 'is-invalid' => $errors->has($name)])
    ->attributes($attributes ?? [])
    ->addClass($class ?? null)
    ->attributeIf($required ?? false, 'required')
    ->attributeIf(isset($slug), 'data-slugify', $slug ?? null)
    ->attributeIf(isset($readonly), 'readonly')
)

<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $groupClass ?? null }}">
    @if(!(isset($label) && $label === false))
        {{ html()->label($label ?? modelAttribute($type, $name), $name)
            ->addClass($label_class ?? null)
        }}
    @endif

    @if(isset($tooltip))
        @php($tooltip_class = $tooltip_class ?? 'fa fa-question-circle')
        {{
            html()->span()
            ->addClass($tooltip_class)
            ->attribute('data-toggle', 'tooltip')
            ->attribute('data-title', $tooltip)
        }}
    @endif

    @if(isset($prepend))
        @component('admin.layouts.components.form.input_number_prepend')
            @slot('prepend', $prepend)
            {{ $input }}
        @endcomponent
    @elseif(isset($append))
        @component('admin.layouts.components.form.input_number_append')
            @slot('append', $append)
            {{ $input }}
        @endcomponent
    @else
        {{ $input }}
    @endif

    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
