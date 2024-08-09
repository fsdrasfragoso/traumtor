@php($id = $id ?? $attribute)
@php($name = $name ?? "q[$attribute]")
@php($label = $label ?? modelAttribute($type, $attribute))
@php($class = $class ?? 'form-control')
@php($options = $options ?? [])

<div class="form-group">
    {{ html()->label($label, $id) }}
    {{ html()->multiselect($name, [])
        ->id($id)
        ->class($class) }}
    @push('scripts')
        <script>
            $(function() {
                $('#{{ $id }}').select2({
                    minimumInputLength: 2,
                    cache: true,
                    ajax: {
                        url: '{{ $url }}',
                        delay: 250,
                        dataType: 'json',
                    }
                });

                @foreach($options as $k => $v)
                    $('#{{ $id }}').append(
                        new Option('{{ $v }}', '{{ $k }}', false, true)
                    );
                @endforeach
                $('#{{ $id }}').trigger('change');
            });
        </script>
    @endpush
</div>
