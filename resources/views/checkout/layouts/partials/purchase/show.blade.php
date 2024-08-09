@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\PaymentProfile $paymentProfile
 * @var \App\Models\Coupon $coupon
 */
@endphp

@extends($template ?? 'checkout.layouts.template')

@section('title', title(__('Pedido realizado com sucesso!')))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12 col-lg-6 pt-0 pt-lg-3 order-1 order-lg-0">

                <div class="status status-pending {{ $status == 'pending' ? '' : 'd-none' }}">
                    <div class="card card--purchase-info">
                        <div class="card-body font-family-secondary">
                            <div class="text-center">
                                <h2 class="h2 mb-2">{!! data_get($purchase_pending, 'title') !!}</h2>
                                <div class="font-weight-light text-left">
                                    <p class="mb-3">{!! data_get($purchase_pending, 'summary') !!}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="dot-typing"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="status status-waiting {{ $status == 'waiting' ? '' : 'd-none' }}">
                    <div class="card card--purchase-info">
                        <div class="card-body font-family-secondary">
                            <div class="d-flex flex-column align-items-center text-center mb-2">
                                <div class="icon mb-2">
                                    <i class="fal fa-check"></i>
                                </div>

                                <h2 class="h2 mb-0">Aguardando pagamento</h2>
                            </div>
                            <div class="font-weight-light text-left">
                                <p class="text-center">Seu pedido já foi processado e está <strong>aguardando confirmação de pagamento</strong>.</p>

                                <span id="valor" class="d-none">{{number_format($price/100, 2, ',', '.')}}</span>

                                @php
                                    $paymentGateway = $bookPurchase->payment_gateway ?? 'asaas';
                                    $paymentMethod = $bookPurchase->payment_method ?? 'credit_card';
                                @endphp

                                @if($paymentGateway == 'asaas' && $paymentMethod == 'pix')
                                    <span id="qr_code" class="d-none">{{data_get($purchase_waiting, 'qr_code.payload')}}</span>

                                    <p class="text-center">
                                        <img id="qr_code_image" src="data:image/jpeg;base64,{{data_get($purchase_waiting, 'qr_code.encoded_image')}}" alt="Qr Code">
                                    </p>

                                    <p class="text-center">
                                        <span id="qr_code_text">{{ data_get($purchase_waiting, 'qr_code.payload') }}</span>
                                        <i onclick="copyToClipboard(event, '#qr_code')" class="fa-md fal fa-clipboard copy-button ml-1" data-toggle="tooltip" title="Copiar"></i>
                                    </p>

                                    <p class="text-center">
                                        <strong>Data de expiração:</strong> <span id="expiration_date">{{ data_get($purchase_waiting, 'qr_code.expiration_date') ? data_get($purchase_waiting, 'qr_code.expiration_date')->format('d/m/Y H:i:s') : '' }}</span>
                                    </p>

                                    <p class="mb-3 mt-3 font-weight-bold text-center">
                                        Valor: {{ moneyFormat($price) }}
                                    </p>
                                @else
                                    <span id="bar_code" class="d-none">{{data_get($purchase_waiting, 'identification_field.bar_code')}}</span>

                                    <p class="mb-3 mt-3">
                                        Clique no botão abaixo para ter acesso ao boleto da sua compra ou copie o código de barras abaixo para realizar o pagamento:
                                    </p>

                                    <p class="mb-3 mt-3">
                                        <a id="bank_split_url" href="{{ data_get($purchase_waiting, 'identification_field.bank_split_url') }}" class="btn btn-primary btn-block text-uppercase" target="_blank">Acessar boleto</a>
                                    </p>

                                    <p class="mb-3 mt-3">
                                        <strong>Código de barras:</strong> <span id="bar_code_text">{{ data_get($purchase_waiting, 'identification_field.bar_code') }}</span>
                                        <i onclick="copyToClipboard(event, '#bar_code')" class="fa-md fal fa-clipboard copy-button ml-1" data-toggle="tooltip" title="Copiar"></i>
                                    </p>

                                    <p class="mb-3 mt-3 text-center">
                                        Confirme os dados e realize o pagamento:
                                    </p>

                                    <p class="mb-3 mt-3 font-weight-bold text-center">
                                        Valor: {{  moneyFormat($price) }}
                                    </p>

                                    <p class="mb-3 text-center">
                                        Após realizar seu pagamento, ele será identificado automaticamente e em até 2 dias úteis realizaremos o despacho do livro.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="status status-failed {{ $status == 'failed' ? '' : 'd-none' }}">
                    <div class="card card--purchase-info">
                        <div class="card-body">
                            <div class="font-family-secondary d-flex flex-column align-items-center text-center mb-2">
                                <div class="text-danger mb-2">
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </div>
                                <h2 class="h2 mb-1 text-danger">Houve um problema com seu pagamento</h2>
                                <p class="reason">{{ $reason }}</p>
                            </div>

                            <div id="payment" class="accordion accordion--payment">

                                @php($paymentMethod = old('payment_method', 'credit_card'))

                                @include('checkout.layouts.partials.purchase.payment-method-credit-card')

                                @include('checkout.layouts.partials.purchase.payment-method-pix')

                                @include('checkout.layouts.partials.purchase.payment-method-bank-split')

                                @push('scripts')
                                    <script>
                                        $('.accordion .payment-method').on('shown.bs.collapse', function () {
                                            var scrollPos = window.pageYOffset;
                                            var $header = $(this).closest('.card');
                                            var top = $('.header__nav').height();
                                            var toScroll = $header.offset().top - top;
                                            if(scrollPos > toScroll) {
                                                $('html,body').animate({
                                                    scrollTop: toScroll
                                                }, 100);
                                            }
                                        });
                                    </script>
                                @endpush

                            </div>

                        </div>
                    </div>
                </div>

                <div class="status status-active status-paid status-scheduled status-trial {{ in_array($status, ['active', 'paid', 'scheduled', 'trial', 'gift']) ? '' : 'd-none' }}">
                    <div class="card card--purchase-info">
                        <div class="card-body font-family-secondary">
                            <div class="d-flex flex-column align-items-center text-center mb-2">
                                <div class="icon mb-2">
                                    <i class="fal fa-check"></i>
                                </div>

                                <h2 class="h2 mb-0">{!! data_get($purchase_active, 'title') !!}</h2>
                            </div>
                            <div class="text-left font-weight-light">
                                <p class="mb-3">{!! data_get($purchase_active, 'summary') ?? config('checkout.thank_you_text') !!}</p>

                                {!! insertVariables([
                                        'name' => data_get($footballer, 'name'),
                                        'first_name' => data_get($footballer, 'first_name'),
                                        'last_name' => data_get($footballer, 'last_name'),
                                        'product' => data_get($product ?? null, 'title'),
                                        'plan' => data_get($plan ?? null, 'title')
                                    ], data_get($purchase_active, 'description'));
                                !!}

                                @if(data_get($purchase_active, 'button_url'))
                                    <a href="{{ data_get($purchase_active, 'button_url') }}" class="btn {{ data_get($purchase_active, 'button_class') ?: 'btn-primary' }} btn-block text-uppercase">{{ data_get($purchase_active, 'button_label') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@include('checkout.layouts.partials.purchase.address-update-modal')

@push('scripts')
    <script>
        $(function() {
            $('#address-confirmation').on('click', function(){
                if($('#address-confirmation').prop("checked") == true){
                    $('#confirm-button').prop("disabled", false);
                } else {
                    $('#confirm-button').prop("disabled", true);
                }
            });
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

@if($status == 'pending')
    @push('scripts')
        <script>
            $(function() {
                var checkStatus = function() {
                    axios.get('{{ $status_url }}')
                        .then(function(response) {
                            var payment_gateway = response.data.payment_gateway || '';
                            var payment_method = response.data.payment_method || '';
                            var status = response.data.status;
                            var reason = response.data.reason;
                            var qr_code = response.data.qr_code;
                            var identification_field = response.data.identification_field;
                            var retry = response.data.retry || {};
                            var can_retry = retry.payment_method && !retry.url;
                            var processing = status == 'pending' || can_retry;

                            if (processing) {
                                setTimeout(checkStatus, 3000);
                            } else {
                                if (retry.url) {
                                    window.location.href = retry.url;
                                } else {
                                    if (identification_field) {
                                        $('#bar_code').text(identification_field.bar_code);
                                        $('#bar_code_text').text(identification_field.bar_code);
                                        $('#bank_split_url').attr("href", identification_field.bank_split_url);
                                    }
                                    if (qr_code) {
                                        $('#qr_code').text(qr_code.payload);
                                        $('#qr_code_text').text(qr_code.payload);
                                        $('#expiration_date').text(moment(qr_code.expiration_date).format('DD/MM/YYYY HH:mm:ss'));
                                        $("#qr_code_image").attr("src", "data:image/jpeg;base64,"+qr_code.encoded_image);                                     
                                    }
                                    if(status === 'paid'){
                                        $('#modal-address-update').modal('show');
                                    }

                                    $('.status').addClass('d-none');
                                    $('.status.status-' + status).removeClass('d-none');
                                    $('.status.status-' + status + ' .reason').html(reason);
                                }
                            }
                        })
                        .catch(function (error) {

                        });
                };

                checkStatus();
            });
        </script>
    @endpush
@endif
