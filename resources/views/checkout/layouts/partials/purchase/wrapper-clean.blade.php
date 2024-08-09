@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\PaymentProfile $paymentProfile
 * @var \App\Models\Coupon $coupon
 */
@endphp

@extends($template ?? 'checkout.layouts.template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 pt-3">
            @yield('form')
        </div>
    </div>
@endsection
