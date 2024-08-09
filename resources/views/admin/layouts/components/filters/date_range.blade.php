@php
    $beginDate = $beginDate ?? now()->startOfDay();
    $endDate = $endDate ?? now()->endOfDay();
@endphp

<div class="form-group">
    {{ html()->label($label, $name) }}
    <div class="input-group">
        {{ html()->text($name, null)->class(['form-control']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
{{ $slot }}

@push('scripts')
<script>
    $(function () {

        var start = moment('{{ $beginDate }}');
        var end = moment('{{ $endDate }}');

        function cb(start, end) {
            $('#{{ $name }} span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }

        $('#{{ $name }}').daterangepicker({
            opens: 'center',
            locale: {format: 'DD/MM/YYYY'},
            startDate: start,
            endDate: end,
            ranges: {
                'Hoje': [moment(), moment()],
                'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Esse mês': [moment().startOf('month'), moment().endOf('month')],
                'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endpush

