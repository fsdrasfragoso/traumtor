@php
$values = request()->input('q.xpromo.contains') ?? [];
@endphp

<div class="form-group">
    {{ html()->label(__('XPROMO'), 'q[xpromo][contains]') }}
    {{ html()->multiselect('q[xpromo][contains]')
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
