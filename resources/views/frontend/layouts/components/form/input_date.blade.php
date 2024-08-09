<div class="form-label-group input-wrapper">
    {{ html()->text($name, $value ?? null)
        ->id($id ?? $name)
        ->class(['form-control', 'date-picker pl-1', 'is-invalid' => $errors->has($name)])
        ->placeholder($placeholder ?? null)
        ->attribute('autocomplete', 'off')
        ->attributeIf($required ?? false, 'required')
        ->attributeIf($disabled ?? false, 'disabled') }}
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')
