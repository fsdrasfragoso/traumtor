@extends('admin.layouts.template_clean')

@section('title', title(__('Recuperar senha')))

@section('content')
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4 mb-4">
                        @if(config('admin.icon'))
                            <img src="{{ config('admin.login_icon') }}" style="width: 128px;" class="align-middle mr-1 mb-3"/>
                        @endif
                        <h1 class="h2">{{ __('Recuperar senha') }}</h1>
                        <p class="lead">
                            Informe seu e-mail para redefinir sua senha
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                {{ html()->form('POST', route('web.admin.password.email'))->open() }}

                                    <div class="form-group">
                                        {{ html()->label(__('E-mail'), 'email') }}
                                        {{ html()->email('email')->class(['form-control', 'form-control-lg', 'is-invalid' => $errors->has('email')])->required(true)->autofocus() }}

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group text-center mb-2">
                                        {{ html()->button(__('Enviar link de recuperação de senha'), 'submit')->class('btn btn-lg btn-primary btn-block') }}
                                    </div>
                                    <div class="text-center">
                                        {{ html()->a(route('web.admin.login'), __('Voltar para o Login')) }}
                                    </div>

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
