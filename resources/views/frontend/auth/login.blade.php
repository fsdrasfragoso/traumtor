@extends('frontend.layouts.template-login')

@section('title', title(__('Login')))

@section('content')

    {{ html()->form('POST', route('web.frontend.login'))
        ->data('redirect-back')
        ->addClass('d-flex flex-column w-100 h-100')
        ->open() }}

    @component('frontend.layouts.components.form.input_text')
        @slot('name', 'email')
        @slot('label', 'E-mail')
        @slot('placeholder', 'E-mail')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_password')
        @slot('name', 'password')
        @slot('label', 'Senha')
        @slot('placeholder', 'Senha')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_switch')
        @slot('name', 'remember')
        @slot('label', 'Manter conectado')
        @slot('checked', old('remember', true))
    @endcomponent

    <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
        <button class="auth-btn" type="button">
            <a href="{{ route('web.frontend.register') }}" data-pjax="#wrapper" data-redirect-back>Criar conta</a>
        </button>
        <button class="auth-btn" type="submit">Entrar</button>
    </div>
    <a href="{{ route('web.frontend.password.request') }}" class="auth-footer-action">{{ __('Esqueci minha senha') }}</a>

    {{ html()->form()->close() }}
@endsection
