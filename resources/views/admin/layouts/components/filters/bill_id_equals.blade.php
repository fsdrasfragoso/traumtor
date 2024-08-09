<div class="form-group">
    {{ html()->label(__('Fatura'), 'q[payment_id][equals]') }}
    {{ html()->text('q[payment_id][equals]', request()->input('q.payment_id.equals'))->class('form-control mask-integer') }}
</div>
