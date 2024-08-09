<div class="form-group">
    {{ html()->label(__('Assinatura'), 'q[subscription_id][equals]') }}
    {{ html()->text('q[subscription_id][equals]', request()->input('q.subscription_id.equals'))->class('form-control mask-integer') }}
</div>
