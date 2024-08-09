<div class="form-group">
    {{ html()->label(__('Forma de pagamento'), 'q[payment_method][equals]') }}
    {{ html()->select('q[payment_method][equals]', config('paymentgateway.methods'), request()->input('q.payment_method.equals'))->placeholder('')->class('form-control') }}
</div>
