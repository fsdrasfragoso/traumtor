<div class="input-wrapper">
    {{ html()->email($name, $value ?? null)
       ->class(['is-invalid' => $errors->has($name)])
       ->addClass($class ?? null)->attributeIf($required ?? false, 'required')
       ->placeholder($placeholder ?? '')
       ->attributeIf($readonly ?? false, 'readonly')
       }}
    {{ $slot }}
</div>
@include('frontend.layouts.components.form.errors')

@push('scripts')
    <script>
        $(function() {
            $('#{{ $name }}').keyup(function() {
                $(this).val($(this).val().toLowerCase());
            });
        });
    </script>
@endpush