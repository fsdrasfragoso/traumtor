<div class="form-group">
    {{ html()->label(__('Pagamentos Inicial'), 'q[ranger_payments][begin]') }}
    <div class="input-group">
        {{ html()->text('q[ranger_payments][begin]', request()->input('q.ranger_payments.begin'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>