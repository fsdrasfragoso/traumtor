<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $name), $name) }}
    {{ html()->email($name, $value ?? null)->class(['form-control', 'is-invalid' => $errors->has($name)])->required(isset($required) ? $required : false) }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
