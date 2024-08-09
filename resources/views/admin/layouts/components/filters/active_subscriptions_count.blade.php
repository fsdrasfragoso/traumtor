<div class="form-group">
    {{ html()->label(__('Quantidade de assinaturas'), 'q[active_subscriptions]') }}
    {{ html()->text('q[active_subscriptions]', request()->input('q.active_subscriptions'))->class('form-control mask-integer') }}
</div>
