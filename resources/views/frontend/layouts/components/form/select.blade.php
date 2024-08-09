<div class="input-wrapper rounded-sm position-relative {{ $classParent ?? null}}">
    {{ html()->select($name, $options, $value ?? null)->id($id ?? $name)->class(['form-control', 'is-invalid' => $errors->has($name)])->attributes($attributes ?? [])->addClass($class ?? null)->attributeIf($required ?? false, 'required')->placeholder($placeholder ?? '') }}
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')
