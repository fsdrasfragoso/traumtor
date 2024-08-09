{{-- <div class="form-group"> --}}
    <div class="switch-wrapper text-gray-800 {{ isset($classes) ? $classes  : ''}}">
        <input type="hidden" name="{{ $name }}" value="0" />
        <span class="switch">
            {{ html()->checkbox($name, isset($checked) ? $checked  : null, isset($value) ? $value :  1)->id($id ?? $name)->class(['custom-control-input bg-primary', 'is-invalid' => $errors->has($name), $inputClass ?? null]) }}
            <span class="switch-circle"></span>
            <span class="bg-switch"></span>
        </span>
        {{ html()->label($label, $id ?? $name)->class('text-gray-800') }}
    </div>
    @include('frontend.layouts.components.form.errors')
    {{ $slot }}
{{-- </div> --}}
