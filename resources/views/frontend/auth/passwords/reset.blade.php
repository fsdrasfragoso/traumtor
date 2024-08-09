@extends('frontend.layouts.template-login')

@section('title', title(__('Redefinir senha')))

@section('content')

    {{ html()->form('POST', route('web.frontend.password.update'))
        ->addClass('d-flex flex-column w-100 h-100')
        ->open() 
    }}

    {{ html()->hidden('token', $token) }}

    @component('frontend.layouts.components.form.input_email')
        @slot('name', 'email')
        @slot('label', 'E-mail')
        @slot('placeholder', 'E-mail')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_password')
        @slot('name', 'password')
        @slot('label', 'Nova Senha')
        @slot('placeholder', 'Nova Senha')
        @slot('required', true)
    @endcomponent

    @component('frontend.layouts.components.form.input_password')
        @slot('name', 'password_confirmation')
        @slot('label', 'Confirmar Senha')
        @slot('placeholder', 'Confirmar Senha')
        @slot('required', true)
    @endcomponent

    <div class="d-flex mt-2">
        <button type="submit" class="auth-btn register-btn text-uppercase">Redefinir Senha</button>
    </div>

    {{ html()->form()->close() }}

@endsection
