<div class="input-wrapper rounded-sm {{ $classParent ?? null}}">
    {{ html()->text($name, $value ?? null)->id($id ?? $name)->class(['form-control', 'is-invalid' => $errors->has($name)])->placeholder($placeholder ?? null)->attributes($attributes ?? [])->addClass($class ?? null)->attributeIf($required ?? false, 'required') }}
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')
