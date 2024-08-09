@php
    $rows = $rows ?? 5;
@endphp

<div class="{{ $groupClass ?? '' }}">
    {{ html()->textarea($name, $value ?? null)
        ->id($id ?? $name)
        ->class(['form-control', 'is-invalid' => $errors->has($name), $inputClass ?? null])
        ->placeholder($placeholder ?? null)
        ->attributes($attributes ?? [])
        ->addClass($class ?? null)
        ->attribute('rows', $rows)
        ->attributeIf($required ?? false, 'required') }}
    {{ html()->label($label ?? '', $name)->class([$labelClass ?? null]) }}
    @include('frontend.layouts.components.form.errors')
    {{ $slot }}
</div>
