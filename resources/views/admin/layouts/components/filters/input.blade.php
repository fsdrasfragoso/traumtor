@php($id = $id ?? $attribute)
@php($name = $name ?? "q[$attribute]")
@php($request_name = $request_name ?? "q.$attribute")
@php($label = $label ?? modelAttribute($type, $attribute))
@php($input_type = $input_type ?? 'text')
@php($class = $class ?? 'form-control')
@php($value = $value ?? "")
<div class="form-group">
    {{ html()->label($label, $id) }}
    {{ html()->input($input_type, $name, request()->input($request_name, $value))
        ->class($class) }}
</div>
