<div class="input-wrapper rounded-sm {{$class ?? null}}">
    {{ html()->input('password', $name)->class(['form-control', 'is-invalid' => $errors->has($name)])->required(isset($required) ? $required : false)->placeholder($placeholder ?? '') }}
    {{-- {{ html()->label($label, $name) }} --}}
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')
