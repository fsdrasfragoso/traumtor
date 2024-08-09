@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\PaymentProfile $paymentProfile
 * @var \App\Models\Coupon $coupon
 */
@endphp

@extends($template ?? 'checkout.layouts.template')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 mt-5 mt-lg-0 pt-3 pt-lg-0 order-1 order-lg-0">

                @yield('form')

            </div>
            <div class="col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 order-0 order-lg-1">
                @component('checkout.layouts.components.checkout-info')
                    @slot('title', $title)
                    @slot('summary', $summary)
                    @slot('image', $image)
                    @slot('items', $items)
                    @slot('items_label', $items_label)
                    @slot('discounts', $discounts)
                    @slot('up_sell_discounts', $up_sell_discounts ?? 0)
                    @slot('price', $price)
                    @slot('custom_price', $custom_price ?? null)
                    @slot('price_label', $price_label)
                    @slot('price_custom', $price_custom ?? null)
                    @slot('installments', $installments ?? null)
                    @slot('max_installments', $max_installments)
                    @slot('first_cycle_price', $first_cycle_price)
                    @slot('one_installment_price', $one_installment_price)
                    @slot('one_installment_discount', $one_installment_discount)
                    @slot('coupon', $coupon)
                    @slot('credits_footballer', $credits_footballer)
                    @slot('credits', $credits)
                    @slot('class', 'mb-3 d-none d-lg-block')
                @endcomponent
                @component('checkout.layouts.components.checkout-info-fixed')
                    @slot('title', $title)
                    @slot('summary', $summary)
                    @slot('image', $image)
                    @slot('items', $items)
                    @slot('items_label', $items_label)
                    @slot('discounts', $discounts)
                    @slot('price', $price)
                    @slot('custom_price', $custom_price ?? null)
                    @slot('price_label', $price_label)
                    @slot('price_custom', $price_custom ?? null)
                    @slot('installments', $installments ?? null)
                    @slot('max_installments', $max_installments)
                    @slot('first_cycle_price', $first_cycle_price)
                    @slot('one_installment_price', $one_installment_price)
                    @slot('one_installment_discount', $one_installment_discount)
                    @slot('coupon', $coupon)
                    @slot('credits_footballer', $credits_footballer)
                    @slot('credits', $credits)
                    @slot('class', 'mb-3')
                @endcomponent

            </div>
        </div>
    </div>

@endsection
