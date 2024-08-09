@php
$values = request()->input("q.$id.or_contains") ?? [];
@endphp

<div class="form-group">
    {{ html()->label(__($label), "q[$id][or_contains]") }}
    {{ html()->multiselect("q[$id][or_contains]")
        ->id($id)
        ->class('form-control') }}
</div>

@push('scripts')
<script>
    $('#{{ $id }}').select2({ tags: true });

    // Créditos à pog de Raposinha
    @foreach($values as $v)
        $('#{{ $id }}').append(
            new Option('{{ $v }}', '{{ $v }}', false, true)
        );
    @endforeach

    $('#{{ $id }}').trigger('change');
</script>
@endpush
