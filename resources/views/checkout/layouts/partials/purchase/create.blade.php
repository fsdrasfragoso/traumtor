@php
    /**
     * @var \App\Models\Footballer $footballer
     * @var Illuminate\Support\Collection $paymentProfiles
     * @var \App\Models\Coupon $coupon
     */

    $paymentMethod = old('payment_method', $paymentProfiles->isEmpty() ? 'credit_card' : 'payment_profile');

    $wrapperLayout = $canNotPurchase ? 'checkout.layouts.partials.purchase.wrapper-clean' : ($wrapper ?? 'checkout.layouts.partials.purchase.wrapper-full');

    $containerClass = $newContainerClass ?? 'container-fluid';

    $colPaymentClass = $newColPaymentClass ?? 'col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 mb-3 order-1 order-lg-0';
    $colInfoClass = $newColInfoClass ?? 'col-12 col-lg-5 col-xl-4 pt-0 pt-lg-3 mt-3 mt-lg-0 order-0 order-lg-1';
    $colExtraClass = $newColExtraClass ?? 'col-12 d-block d-lg-none mb-3 order-2 font-family-secondary';

    $showInfoFixed = $newShowInfoFixed ?? true;

    $paymentProfiles = $paymentProfiles ?? [];
    $bankTransferProfiles = $bankTransferProfile ?? [];
@endphp

@extends($wrapperLayout)

@section('title', title(__('Comprar ') . $title))

@section('form')
    @if($canNotPurchase)
        <div class="card">
            <div class="card-body">
                <div class="font-family-secondary text-center">
                    <h2 class="h2">{{ trans($canNotPurchase) }}</h2>
                    <p>{{ trans($canNotPurchase.'.description') }}</p>
                    @if($canNotPurchase == 'validation.already_has_subscription' || $canNotPurchase == 'validation.already_has_all_subscriptions')
                        <a class="btn btn-primary btn-lg text-uppercase"
                           href="{{ route('web.frontend.default.index') }}">Voltar para a minha área</a>
                    @else
                        <a class="btn btn-primary btn-lg text-uppercase"
                           href="{{ route('web.frontend.books.index') }}">Voltar para a Vitrine</a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div id="payment" class="accordion accordion--payment">
                    @foreach($paymentProfiles as $paymentProfile)
                        @include('checkout.layouts.partials.purchase.payment-method-payment-profile', [
                            'isFirst' => $loop->first
                        ])
                    @endforeach

                    @include('checkout.layouts.partials.purchase.payment-method-credit-card')

                    <span id="valor" class="d-none">{{$price}}</span>
                    <span id="razao_social" class="d-none">PERFECT PAY LTDA</span>
                    <span id="banco" class="d-none">341</span>
                    <span id="cnpj" class="d-none">28265605000123</span>
                    <span id="agencia" class="d-none">0350</span>
                    <span id="conta" class="d-none">207072</span>

                    @include('checkout.layouts.partials.purchase.payment-method-pix')

                    @include('checkout.layouts.partials.purchase.payment-method-bank-split')

                    @push('scripts')
                        <script>
                            $('.accordion .payment-method').on('shown.bs.collapse', function () {
                                var scrollPos = window.pageYOffset;
                                var $header = $(this).closest('.card');
                                var top = $('.header__nav').height();
                                var toScroll = $header.offset().top - top;
                                if (scrollPos > toScroll) {
                                    $('html,body').animate({
                                        scrollTop: toScroll
                                    }, 100);
                                }
                            });

                            function copyToClipboard(event, element) {
                                event.preventDefault();
                                var $temp = $("<input>");
                                $("body").append($temp);
                                $temp.val($(element).text()).select();
                                document.execCommand("copy");
                                $temp.remove();
                                $(event.target).attr('data-original-title', "Copiado").tooltip('show');
                            }

                            $('.copy-button').on('hidden.bs.tooltip', function () {
                                $('.copy-button').attr('data-original-title', "Copiar");
                            })

                        </script>
                    @endpush

                </div>
            </div>
        </div>

    @endif
@endsection
