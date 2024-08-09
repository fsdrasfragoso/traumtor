@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\PaymentProfile $paymentProfile
 * @var \App\Models\Coupon $coupon
 */
@endphp

@extends($template ?? 'checkout.layouts.template')

@section('content')
    <div class="{{ $containerClass }}">
        <div class="row justify-content-center">

            <div class="{{ $colPaymentClass }}">

               @yield('form')

            </div>
            <div class="{{ $colInfoClass }}">

                @component('checkout.layouts.components.checkout-info')
                    @slot('title', $title)
                    @slot('summary', $summary)
                    @slot('image', $image)
                    @slot('price', $price)
                    @slot('installments', $installments ?? null)
                    @slot('max_installments', $max_installments)
                    @slot('first_cycle_price', $first_cycle_price)
                    @slot('class', 'mb-3')
                @endcomponent
            </div>
        </div>
    </div>

@endsection
