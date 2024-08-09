@php
$values = request()->input($name ?? 'q.xpromo.or_contains') ?? [];
@endphp

<div class="form-group">
    {{ html()->label(__('XPROMO'), $id ?? 'q[xpromo][or_contains]') }}
    {{ html()->multiselect($id ?? 'q[xpromo][or_contains]')
        ->id('xpromo')
        ->class('form-control') }}
</div>

@push('scripts')
<script>
    $('#xpromo').select2({ tags: true });

    // Créditos à pog de Raposinha
    @foreach($values as $v)
        $('#xpromo').append(
            new Option('{{ $v }}', '{{ $v }}', false, true)
        );
    @endforeach

    $('#xpromo').trigger('change');
</script>
@endpush
