@php
    $config = 'gateways';
    $title = 'Gateway de pagamento';
    if (class_basename($type) == 'Webhook') {
        $config = 'webhooks';
        $title = 'Gateway';
    }
@endphp

<div class="form-group">
    {{ html()->label(__($title), 'q[payment_gateway][equals]') }}
    {{ html()->select('q[payment_gateway][equals]', config('paymentgateway.'.$config), request()->input('q.payment_gateway.equals'))->placeholder('')->class('form-control') }}
</div>
