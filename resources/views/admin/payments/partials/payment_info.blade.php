<table class="table table-striped">
    <tr>
        <td class="shrink"><strong>{{ __('ID') }}</strong></td>
        <td>#{{ $payment->id }}</td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Status') }}</strong></td>
        <td><span class="badge badge-status-{{ $payment->status }}">{{ modelAttribute(\App\Models\Payment::class, 'options.status.' . $payment->status) }}</span>
        </td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Data de Criação') }}</strong></td>
        <td>{{ $payment->created_at->format(config('admin.timestamp_format')) }}</td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Pagamento') }}</strong></td>
        <td>
            {{ modelAttribute(\App\Models\Payment::class, 'options.payment_method.' . $payment->payment_method) }}
        </td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Gateway') }}</strong></td>
        <td>{{ modelAttribute(\App\Models\Payment::class, 'options.payment_gateway.' . $payment->payment_gateway) }}
            @if($payment->external_code)
                <span class="badge badge-info">{{ $payment->external_code }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Valor') }}</strong></td>
        <td>{{ moneyFormat($payment->amount) }}</td>
    </tr>
    <tr>
        <td class="shrink"><strong>{{ __('Parcelamento') }}</strong></td>
        <td>{{ $payment->installments }}x</td>
    </tr>
</table>