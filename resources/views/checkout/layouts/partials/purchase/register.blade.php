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

@section('title', title(__('Cadastre-se') . ' - ' . $title))

@section('form')
    <div class="card">
        <div class="card-body">

            <h3 class="h3 font-family-secondary font-weight-bold">
                Preencha seus dados para comprar
            </h3>

            {{ html()->form('POST', route('web.frontend.register'))->data('validation', route('web.frontend.register.validation'))->open() }}

            {{ html()->hidden('redirect_url', $create_url) }}


            @component('frontend.layouts.components.form.input_email')
                @slot('name', 'email')
                @slot('label', 'E-mail')
                @slot('class', 'form-control')
                @slot('placeholder', 'E-mail')
                @slot('value', old('email', request('email')))
                @slot('required', true)
            @endcomponent

            @component('frontend.layouts.components.form.input_text')
                @slot('name', 'name')
                @slot('label', 'Nome completo')
                @slot('placeholder', 'Nome completo')
                @slot('required', true)
            @endcomponent

            @component('frontend.layouts.components.form.input_password')
                @slot('name', 'password')
                @slot('label', 'Senha')
                @slot('placeholder', 'Senha')
                @slot('required', true)
            @endcomponent

            @component('frontend.layouts.components.form.input_password')
                @slot('name', 'password_confirmation')
                @slot('label', 'Confirmar Senha')
                @slot('placeholder', 'Confirmar Senha')
                @slot('required', true)
            @endcomponent

            @component('frontend.layouts.components.form.input_text')
                @slot('name', 'document')
                @slot('label', 'CPF')
                @slot('placeholder', 'CPF')
                @slot('class', 'mask-cpf')
                @slot('required', true)
            @endcomponent

            @component('frontend.layouts.components.form.input_text')
                @slot('name', 'phone')
                @slot('label', 'Telefone')
                @slot('placeholder', 'Telefone')
                @slot('class', 'mask-phone')
                @slot('required', true)
            @endcomponent

            <div class="form-address">

                @component('frontend.layouts.components.form.input_text')
                    @slot('name', 'zip_code')
                    @slot('label', 'CEP')
                    @slot('placeholder', 'CEP')
                    @slot('class', 'mask-zipcode')
                    @slot('required', true)
                @endcomponent

                <div class="row show-on-load {{ old('zip_code') ? '' : 'd-none' }}">
                    <div class="col-lg-8">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'street')
                            @slot('label', 'Rua')
                            @slot('placeholder', 'Rua')
                            @slot('required', true)
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'number')
                            @slot('label', 'Número')
                            @slot('placeholder', 'Número')
                            @slot('required', true)
                            @slot('attributes', [
                                'maxlength' => 9,
                            ])
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'neighborhood')
                            @slot('label', 'Bairro')
                            @slot('placeholder', 'Bairro')
                            @slot('required', true)
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'complement')
                            @slot('label', 'Complemento')
                            @slot('placeholder', 'Complemento')
                        @endcomponent
                    </div>
                    <div class="col-lg-4">
                        @component('frontend.layouts.components.form.select')
                            @slot('name', 'state')
                            @slot('label', 'Estado')
                            @slot('options', \App\Models\Footballer::stateOptions())
                            @slot('required', true)
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        @component('frontend.layouts.components.form.input_text')
                            @slot('name', 'city')
                            @slot('label', 'Cidade')
                            @slot('placeholder', 'Cidade')
                        @endcomponent
                    </div>

                </div>

            </div>

            <div class="col-lg-12 pl-0 terms">
                @component('frontend.layouts.components.form.input_checkbox')
                    @slot('name', 'terms')
                    @slot('required', true)
                    @slot('group_class', $class ?? '')
                    @slot('label')
                    <span class="text-body">
                        Eu li e aceito os <a target="_blank" href="https://help.traumtor.com.br/article/61-temos-de-uso"> Termos de uso</a> e <a target="_blank" href="https://help.traumtor.com.br/article/62-politica-de-privacidade"> Política de Privacidade </a>
                    </span>
                    @endslot
                @endcomponent
            </div>

            <div class="form-group mt-3 mb-3">
                <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase">
                    Cadastre-se
                </button>
            </div>
            <div>
                <a href="{{ $login_url }}" data-pjax="#main" data-pjax-scroll="#wrapper" class="link">{{ __('Já sou cadastrado') }}</a>
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
		$(function() {
			$('#name').focus();
		});
    </script>
@endpush
