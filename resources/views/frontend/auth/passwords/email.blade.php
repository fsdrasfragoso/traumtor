@extends('frontend.layouts.template-login')

@section('title', title(__('Recuperar senha')))

@section('content')
    {{ html()->form('POST', route('web.frontend.password.email'))
        ->addClass('d-flex flex-column w-100 h-100')
        ->open() 
    }}

        @component('frontend.layouts.components.form.input_email')
            @slot('name', 'email')
            @slot('label', 'E-mail')
            @slot('placeholder', 'E-mail')
            @slot('required', true)
            @if(request()->has('email'))
                @slot('value',request()->get('email'))
                @slot('readonly',true)
            @endif
        @endcomponent
        <div class="d-flex mt-2">
            <button type="submit" class="w-100 auth-btn register-btn text-uppercase">
                <span class="mr-1">Enviar</span>
            </button>
        </div>
        <a href="{{ route('web.frontend.login') }}"  class="auth-footer-action">Voltar para o Login</a>

    {{ html()->form()->close() }}
@endsection
