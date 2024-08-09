<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $class ?? '' }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    {{ html()->textarea($name, $value ?? null)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attribute('rows', $rows ?? 5)
        ->attributeIf($required ?? false, 'required')
        ->attributeIf($disabled ?? false, 'disabled')}}
    {{ $slot }}
    @if($limit ?? false)
        <small 
            class="d-flex justify-content-end {{ isset($value) && isset($limit) && strlen($value) > $limit ? 'text-danger' : '' }}" 
            id="limit-value-{{ $name }}">
                {{ isset($value) ? strlen($value) : 0 }}/{{ ($limit) }} caracteres
        </small>
    @endif
</div>

@push('scripts')
    <script>

        function maxLength(el) {
            let max = '{{ $limit ?? 0 }}';

            el.onkeyup = function () {
                $('#limit-value-{{ $name }}').html(`${this.value.length}/${(max)} caracteres`);

                $('#limit-value-{{ $name}}').removeClass('text-danger');

                if (this.value.length > max) {
                    $('#limit-value-{{$name}}').addClass('text-danger');
                }
            };
        }

        $(function() {
            maxLength(document.getElementById("{{ $name }}"));
        });
    </script>
@endpush
