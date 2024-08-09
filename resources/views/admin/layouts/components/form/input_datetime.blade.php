<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $class ?? '' }}">
    @if (!isset($label) || $label !== '')
        {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    @endif
    <div class="input-group">
        {{ html()->text($name, $value ?? null)
            ->class(['form-control', 'datetime-picker', 'is-invalid' => $errors->has($name)])
            ->attribute('autocomplete', 'off')
            ->attributeIf($required ?? false, 'required')
            ->attributeIf($disabled ?? false, 'disabled') }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
