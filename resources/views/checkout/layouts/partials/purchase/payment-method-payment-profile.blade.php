@php($hideInstallments = $hideInstallments ?? false)
@php($isFirst = $isFirst ?? false)
@php($show = false)
@if($paymentMethod == 'payment_profile')
    @if(old('payment_profile_id') == $paymentProfile->id || $isFirst)
        @php($show = true)
    @endif
@endif

<div class="card">
    <div class="card-header">
        <button class="btn btn-link btn-block {{ $show ? '' : 'collapsed' }}" data-toggle="collapse" data-target=".payment-method.payment_profile[data-payment-profile-id='{{ $paymentProfile->id }}']">
            <span class="icon mr-1"><i class="fal fa-check"></i></span>
            <span class="text d-flex">
                <img class="mr-1" src="/img/frontend/card-flags/flag-{{ $paymentProfile->flag }}.png" style="height: 20px;" />
                {{ $paymentProfile->serial }} ({{ $paymentProfile->getMethodName() }})
            </span>
        </button>
    </div>
    <div class="card-body payment-method payment_profile fade collapse {{ $show ? 'show' : '' }}" data-parent="#payment" data-payment-profile-id="{{ $paymentProfile->id }}">

        {{ html()->form('POST', $store_url)->class('checkout-form')->open() }}

        <input type="hidden" name="payment_method" value="payment_profile" />
        <input type="hidden" name="payment_profile_id" value="{{ $paymentProfile->id }}" />

        @if(isset($cross_sell))
            <input type="hidden" name="cross_sell_offer_id" value="{{ $cross_sell['cross_sell_offer_id'] }}">
            <input type="hidden" name="cross_sell_offer_subscription_id" value="{{ $cross_sell['cross_sell_offer_subscription_id'] }}">
            <input type="hidden" name="cross_sell_offer_linked_purchase_id" value="{{ $cross_sell['cross_sell_offer_linked_purchase_id'] }}">
        @endif

        <div class="row font-family-secondary mb-2">
            <div class="col-12 mb-2">
                <span class="text-muted">Titular do cartão</span><br>
                <strong>{{ $paymentProfile->holder }}</strong>
            </div>
            <div class="col-lg-6 mb-2 mb-lg-0">
                <span class="text-muted">Número do cartão</span><br>
                <strong>{{ $paymentProfile->serial }}</strong>
            </div>
            <div class="col-lg-6">
                <span class="text-muted">Validade</span><br>
                <strong>{{ sprintf('%02d', $paymentProfile->month) . '/' . $paymentProfile->year  }}</strong>
            </div>
        </div>
        <div class="row">
            @if($max_installments > 1 && !$hideInstallments)
                <div class="col-12 order-1">
                    @component('frontend.layouts.components.form.select')
                        @slot('name', 'installments')
                        @slot('id', 'credit_card_installments')
                        @slot('label', 'Pagamento')
                        @slot('placeholder', 'Pagamento')
                        @slot('options', $price_installments_options)
                        @slot('required', true)
                    @endcomponent
                </div>
            @else
                <input type="hidden" name="installments" value="1" />
            @endif

            <div class="col-12 order-lg-4 order-3">
                <div class="form-group mt-1 mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase {{ user() ? '' : 'confirm-purchase' }}">
                        Finalizar compra
                    </button>
                </div>
            </div>

        </div>

        {{ html()->form()->close() }}
    </div>
</div>
