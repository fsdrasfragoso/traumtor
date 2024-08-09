<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    <div class="custom-control custom-checkbox align-items-center">
        <input type="hidden" name="{{ $name }}" value="0" />
        {{ html()->checkbox($name, isset($checked) ? $checked : null )
            ->attributeIf($disabled ?? false, 'disabled')
            ->class(['custom-control-input', 'is-invalid' => $errors->has($name)]) }}
        {{ html()->label($label ?? modelAttribute($type, $name), $name)->class('custom-control-label') }}
    </div>
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
