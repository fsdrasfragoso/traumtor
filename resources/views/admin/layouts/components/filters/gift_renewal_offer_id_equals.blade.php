<div class="form-group">
    {{ html()->label(__('Oferta de Renovação'), 'q[gift_renewal_offer_id][equals]') }}
    {{ html()->select('q[gift_renewal_offer_id][equals]', $gift_renewal_offers, request()->input('q.gift_renewal_offer_id.equals'))->placeholder(null)->class('form-control') }}
</div>
