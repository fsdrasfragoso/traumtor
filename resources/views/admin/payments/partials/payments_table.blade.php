@php
if(!isset($periods)) {
    $periods = true;
}
@endphp

@inject('paymentService', 'App\Services\PaymentService')

<table class="table">

    <thead>
    <tr>
        <th>Fatura</th>
        <th class="shrink">Valor</th>
        <th class="shrink">Status</th>
        <th class="shrink"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($payments as $payment)
        <tr class="bg-status-{{ $payment->status }} text-white">
            <td>
                Fatura #{{ $payment->id }}
            </td>
            <td class="shrink">{{ moneyFormat($payment->amount) }}
                @if($payment->installments > 1)
                    ({{ $payment->installments }}x)
                @endif
            </td>
            <td class="shrink">{{ modelAttribute(\App\Models\Payment::class, 'options.status.'.$payment->status) }}</td>
            <td class="shrink">
                @if($payment->canRefund())
                    <a href="{{ $payment->route('refund') }}" class="btn btn-light text-danger btn-sm" data-toggle="tooltip" title="Estornar fatura"><i class="far fa-undo"></i></a>
                @endif
                
                {!! $payment->getAdminActions() !!}
            </td>
        </tr>

        <tr>
            <td colspan="6" class="p-0 pl-3">

            </td>
        </tr>

    @empty

    @endforelse
    </tbody>

</table>
