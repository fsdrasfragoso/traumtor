<div class="form-group {{ $group_class ?? '' }}">
    <div class="custom-control custom-checkbox align-items-center">
        <input type="hidden" class="{{  $class ?? '' }}" name="{{ $name }}" value="0" />
        {{ html()->checkbox($name, isset($checked) ? $checked : null, isset($value) ? $value : 1)->class(['custom-control-input', 'is-invalid' => $errors->has($name), $class ?? ''])->attributeIf($required ?? false, 'required') }}
        {{ html()->label($label, $name)->class('custom-control-label') }}
    </div>
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')
