@php
/** @var \App\Models\Payment $instance */
$payment = $instance;
$reference = $payment->reference;
$footballer =  $reference->footballer;

$full_refund = ($instance->amount - $instance->refund_amount);

@endphp

@extends('admin.layouts.template')

@section('title', title(modelAction($type, 'show')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('breadcrumbs', app('breadcrumbs'))
    @endcomponent

    <div class="row">
        <div class="col-lg-6">
            @component('admin.layouts.components.card_clean')
                @slot('title', __('Fatura'))
                @include('admin.payments.partials.payment_info')
            @endcomponent

            @if($footballer)
                @component('admin.layouts.components.card_clean')
                    @slot('title', __('Futebolista'))
                    @include('admin.footballers.partials.footballer_info')
                @endcomponent
            @endif

        </div>
        @if($instance->canRefund())
            <div class="col-lg-6">
                {{ html()->form('POST', $instance->route('refundStore'))->open() }}
                @component('admin.layouts.components.card')
                    @slot('title', __('Estorno'))

                    <p>Total permitido: <strong>{{ moneyFormat($full_refund) }}</strong></p>
                    @component('admin.layouts.components.form.input_text')
                        @slot('type', $type)
                        @slot('name', 'amount')
                        @slot('class', 'mask-currency strip-before-send')
                        @slot('required', true)
                        @slot('prepend', 'R$')
                        <small class="form-text text-muted">
                            Mínimo: R$5,00; Máximo: {{ moneyFormat($full_refund) }}
                        </small>
                    @endcomponent

                    <div class="reason-input">
                        @component('admin.layouts.components.form.input_text')
                            @slot('label', 'Motivo')
                            @slot('name', 'refund_reason')
                        @endcomponent
                    </div>

                    <div class="form-group">
                        {{ html()->submit('Estornar')->class('btn btn-primary') }}
                    </div>

                @endcomponent

                {{ html()->form()->close() }}
            </div>
        @endif
    </div>

@stop

@push('scripts')
    <script>

        $(function() {
            const max = {{ $full_refund }};

            $('#amount').on('keyup', function () {
                let value = parseInt(this.value.replace(/\D/g, ''));

                console.log(value);

                if (value !== '') {
                    $('#amount').parents('.form-group')
                        .find('.form-control')
                        .toggleClass('is-invalid', value > max || value < 500);
                    $('#amount').parents('form').find('[type=submit]').prop('disabled', value > max || value < 500);
                }
            }).trigger('keyup');
        });

    </script>
@endpush
