<table class="table table-striped">
    <tr>
        <td class="shrink"><strong>{{ __('Ciclo') }}</strong></td>
        <td>{{ $period->cycle }}</td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Período') }}</strong></td>
        <td>{{ $period->start_at->format('d/m/Y') . ' - ' . ($period->end_at ? $period->end_at->format('d/m/Y') : 'Indeterminado') }}</td>
    </tr>
</table>