@php($hideInstallments = $hideInstallments ?? false)

<div class="card">
    <div class="card-header">
        <button class="btn btn-link btn-block btn-payment {{ $paymentMethod == 'credit_card' ? '' : 'collapsed' }}" data-toggle="collapse" data-target=".payment-method.credit_card">
            <span class="icon mr-1"><i class="fal fa-check"></i></span>
            <span class="d-flex flex-wrap">
                <span class="text flex-shrink-0 mr-1">
                    Cartão de Crédito
                </span>
                <span class="flags d-flex align-items-center">
                    <img class="mr-1" src="{{ asset('img/frontend/card-flags/flag-visa.png') }}" style="height: 20px"/>
                    <img class="mr-1" src="{{ asset('img/frontend/card-flags/flag-mastercard.png') }}" style="height: 20px" />
                    <img class="mr-1" src="{{ asset('img/frontend/card-flags/flag-american_express.png') }}" style="height: 20px" />
                    <img class="mr-1" src="{{ asset('img/frontend/card-flags/flag-elo.png') }}" style="height: 20px" />
                    <img src="{{ asset('img/frontend/card-flags/flag-hipercard.png') }}" style="height: 20px" />
                </span>
            </span>
        </button>
    </div>
    <div class="card-body payment-method credit_card fade collapse {{ $paymentMethod == 'credit_card' ? 'show' : '' }}" data-parent="#payment">
        {{ html()->form('POST', $store_url)->class('checkout-form')->open() }}

        <input type="hidden" name="payment_method" value="credit_card" />

        @if(isset($cross_sell))
            <input type="hidden" name="cross_sell_offer_id" value="{{ $cross_sell['cross_sell_offer_id'] }}">
            <input type="hidden" name="cross_sell_offer_subscription_id" value="{{ $cross_sell['cross_sell_offer_subscription_id'] }}">
            <input type="hidden" name="cross_sell_offer_linked_purchase_id" value="{{ $cross_sell['cross_sell_offer_linked_purchase_id'] }}">
        @endif

        <div class="row">
            <div class="col-12 order-1">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                @component('frontend.layouts.components.form.input_text')
                                    @slot('name', 'serial')
                                    @slot('id', 'credit_card_serial')
                                    @slot('label', 'Número do cartão')
                                    @slot('placeholder', 'Número do cartão')
                                    @slot('value', '')
                                    @slot('class', 'mask-creditcard strip-before-send')
                                    @slot('attributes', [
                                        'autocomplete' => 'cc-number',
                                        'data-flag' => '#credit_card_flag',
                                    ])
                                    @slot('required', true)
                                @endcomponent
                            </div>
                            <div id="credit_card_flag_image" class="flex-shrink-0 d-flex align-items-center ml-1">
                                <img src="{{ asset('img/frontend/card-flags/default.png') }}" style="width: 36px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        @component('frontend.layouts.components.form.select')
                            @slot('name', 'flag')
                            @slot('id', 'credit_card_flag')
                            @slot('label', 'Bandeira')
                            @slot('placeholder', 'Bandeira')
                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::flagOptions())
                            @slot('required', true)
                        @endcomponent
                    </div>

                    <div class="col-lg-12 mb-2">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'holder')
                            @slot('id', 'credit_card_holder')
                            @slot('label', 'Titular do cartão')
                            @slot('placeholder', 'Titular do cartão')
                            @slot('attributes', [
                                'autocomplete' => 'cc-name',
                            ])
                            @slot('required', true)
                        @endcomponent
                    </div>
                    <div class="col-6 mb-2">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                @component('frontend.layouts.components.form.input_text')
                                    @slot('name', 'cvv')
                                    @slot('id', 'credit_card_cvv')
                                    @slot('label', 'CVV')
                                    @slot('placeholder', 'CVV')
                                    @slot('attributes', [
                                        'autocomplete' => 'cc-csc',
                                    ])
                                    @slot('required', true)
                                @endcomponent
                            </div>
                            <div class="flex-shrink-0 d-flex align-items-center ml-1">
                                <img src="{{ asset('img/frontend/card-flags/card-cvv.png') }}" style="width: 36px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-6 mb-2">
                        @component('frontend.layouts.components.form.select')
                            @slot('name', 'month')
                            @slot('id', 'credit_card_month')
                            @slot('label', 'Mês')
                            @slot('placeholder', 'Mês')
                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::monthOptions())
                            @slot('attributes', [
                                'autocomplete' => 'cc-exp_month',
                            ])
                            @slot('required', true)
                        @endcomponent
                    </div>
                    <div class="col-6 mb-2">
                        @component('frontend.layouts.components.form.select')
                            @slot('name', 'year')
                            @slot('id', 'credit_card_year')
                            @slot('label', 'Ano')
                            @slot('placeholder', 'Ano')
                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::yearOptions())
                            @slot('attributes', [
                                'autocomplete' => 'cc-exp-year',
                            ])
                            @slot('required', true)
                        @endcomponent
                    </div>

                    @if(isset($installments) && $installments)
                        <input type="hidden" name="installments" value="{{ $installments }}" />
                    @else
                        @if($max_installments > 1 && !$hideInstallments)
                            <div class="col-12 mb-2">
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
                    @endif
                </div>
            </div>

            @if(isset($allow_debit) && $allow_debit)
            <div class="col-12">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        {{ html()->checkbox('allow_debit', true)->class(['custom-control-input']) }}
                        {{ html()->label('Em caso de falha no crédito, autorizo o débito neste mesmo cartão.', 'allow_debit')->class('custom-control-label') }}
                    </div>
                </div>
            </div>
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

@push('scripts')
    <script>
		$('#credit_card_flag').on('change', function() {
			var image = $(this).val() ? 'flag-' + $(this).val() + '.png' : 'default.png';
			$('#credit_card_flag_image img').attr('src', '/img/frontend/card-flags/' + image);
		});
    </script>
@endpush
