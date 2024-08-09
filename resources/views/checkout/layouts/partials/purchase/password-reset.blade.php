@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\PaymentProfile $paymentProfile
 * @var \App\Models\Coupon $coupon
 */

    $containerClass = $newContainerClass ?? 'container-fluid';

    $colPaymentClass = $newColPaymentClass ?? 'col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 mb-3 order-1 order-lg-0';
    $colInfoClass = $newColInfoClass ?? 'col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 mt-3 mt-lg-0 order-0 order-lg-1';
    $colExtraClass = $newColExtraClass ?? 'col-12 d-block d-lg-none mb-3 order-2 font-family-secondary';

    $showInfoFixed = $newShowInfoFixed ?? true;
@endphp

@extends($wrapper ?? 'checkout.layouts.partials.purchase.wrapper-full')

@section('title', title(__('Recuperar senha') . ' - ' . $title))

@section('form')
    <div class="card mb-3">
        <div class="card-body">

            <h3 class="h3 font-family-secondary font-weight-bold">
                Insira seu e-mail para recuperar sua senha
            </h3>

            {{ html()->form('POST', route('web.frontend.password.email'))->data('pjax', '#main')->data('pjax-scroll', '#wrapper')->open() }}

            @component('frontend.layouts.components.form.input_email')
                @slot('name', 'email')
                @slot('label', 'E-mail')
                @slot('placeholder', 'E-mail')
                @slot('value', old('email', request('email')))
                @slot('required', true)
            @endcomponent

            <div class="mt-3 mb-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase">
                        Enviar
                    </button>
                </div>
            </div>
            <div>
                <a href="{{ $login_url }}" data-pjax="#main" data-pjax-scroll="#wrapper" class="link">Voltar para o Login</a>
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
        	$('#password').focus();
        });
    </script>
@endpush
