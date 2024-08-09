<div class="form-group {{ $class ?? null }} {{ isset($required) && $required ? 'required' : ''  }}">
    <div class="custom-control custom-radio align-items-center" style="padding-left:0">
        {{ html()->radio($name, $checked, $value)->disabled(isset($disabled))->required(isset($required) && $required) }}&nbsp;
        {{ html()->label($label)->class(isset($disabled) ? 'text-gray-300' : null) }}
    </div>
    {{ $slot }}
</div>
