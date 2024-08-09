<div class="form-group">
    {{ html()->label(__('Ciclo adicional'), 'q[renewal_offer_id][equals]') }}
    {{ html()->select('q[renewal_offer_id][equals]', $renewal_offers, request()->input('q.renewal_offer_id.equals'))->placeholder(null)->class('form-control') }}
</div>
