@php
/** @var \App\Models\Payment $instance */

$payment = $instance;
$subscription = $payment->subscription;
$period = $payment->period;
$reference = $payment->reference;

if($subscription) {
    $footballer = $subscription->footballer;
} else {
    $footballer = $reference->footballer;
}

@endphp

@extends('admin.layouts.template')

@section('title', title(modelAction($type, 'show')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('breadcrumbs', app('breadcrumbs'))
        @slot('aside')
            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Ações</button>
                <div class="dropdown-menu dropdown-menu-right">
                    @if($instance->canRefund())
                        <a href="{{ $instance->route('refund') }}" class="dropdown-item">
                            <i class="text-danger mr-2 far fa-undo"></i> Estornar fatura
                        </a>
                    @endif
                    @if($instance->canUpdate())
                        <a href="#" data-toggle="modal" data-target="#modal-update" class="dropdown-item">
                            <i class="text-primary mr-2 far fa-pencil"></i> Alterar fatura
                        </a>
                    @endif
                </div>
            </div>
        @endslot

    @endcomponent

    <div class="row">


        <div class="col-lg-6">
            @component('admin.layouts.components.card_clean')
                @slot('title', __('Fatura'))
                @include('admin.payments.partials.payment_info')
            @endcomponent
        </div>

        <div class="col-lg-6">
            @if(isset($footballer))
                @component('admin.layouts.components.card_clean')
                    @slot('title', __('Futebolista'))
                    @include('admin.footballers.partials.footballer_info')
                @endcomponent
            @endif

        </div>
    </div>

    @includeWhen($instance->canUpdate(), 'admin.payments.partials.modal_update')
@stop

@push('scripts')
    <script>
        $(function() {
            $(window.location.hash).modal('show')
        });
    </script>
@endpush
