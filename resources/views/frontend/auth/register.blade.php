@extends('frontend.layouts.template-login')

@section('title', title(__('Cadastre-se')))

@section('content')

    {{ html()->form('POST', route('web.frontend.register'))
        ->data('validation', route('web.frontend.register.validation'))
        ->data('redirect-back')
        ->addClass('d-flex flex-column w-100 h-100')
        ->open() }}

    @component('frontend.layouts.components.form.input_text')
        @slot('name', 'name')
        @slot('label', 'Nome completo')
        @slot('placeholder', 'Nome completo *')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_email')
        @slot('name', 'email')
        @slot('label', 'E-mail')
        @slot('placeholder', 'E-mail *')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_password')
        @slot('name', 'password')
        @slot('label', 'Senha')
        @slot('placeholder', 'Senha *')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_password')
        @slot('name', 'password_confirmation')
        @slot('label', 'Confirmar Senha')
        @slot('placeholder', 'Confirmar Senha *')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_text')
        @slot('name', 'document')
        @slot('label', 'CPF')
        @slot('placeholder', 'CPF *')
        @slot('class', 'mask-cpf')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_text')
        @slot('name', 'phone')
        @slot('label', 'Telefone')
        @slot('placeholder', 'Telefone *')
        @slot('class', 'mask-phone')
        @slot('required', true)
    @endcomponent

    <div class="form-address">

        @component('frontend.layouts.components.form.input_text')
            @slot('name', 'zip_code')
            @slot('label', 'CEP')
            @slot('placeholder', 'CEP *')
            @slot('class', 'mask-zipcode')
            @slot('required', true)
        @endcomponent

        <div class="row show-on-load {{ old('zip_code') ? '' : 'd-none' }}">
            <div class="col-lg-8">
                @component('frontend.layouts.components.form.input_text')
                    @slot('name', 'street')
                    @slot('label', 'Rua')
                    @slot('placeholder', 'Rua *')
                    @slot('required', true)
                @endcomponent
            </div>
            <div class="col-lg-4">
                @component('frontend.layouts.components.form.input_text')
                    @slot('name', 'number')
                    @slot('label', 'Número')
                    @slot('placeholder', 'Número *')
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
                    @slot('placeholder', 'Bairro *')
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
                    @slot('options', [])
                    @slot('required', true)
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
            <span>
                Eu li e aceito os <a class="text-white" target="_blank" href="https://help.traumtor.com.br/article/61-temos-de-uso"> Termos de uso</a> e <a class="text-white" target="_blank" href="https://help.traumtor.com.br/article/62-politica-de-privacidade"> Política de Privacidade </a>
            </span>
            @endslot
        @endcomponent
    </div>

    <div class="d-flex pt-2">
        <button type="submit" class="auth-btn register-btn">
            Entrar
        </button>
    </div>
    <a href="{{ route('web.frontend.login') }}" class="auth-footer-action" data-redirect-back>{{ __('Já sou cadastrado') }}</a>

    {{ html()->form()->close() }}

@endsection
