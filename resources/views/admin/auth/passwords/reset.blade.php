@extends('admin.layouts.template_clean')

@section('title', title(__('Redefinir senha')))

@section('content')
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4 mb-4">
                        @if(config('admin.icon'))
                            <img src="{{ config('admin.login_icon') }}" style="width: 128px;" class="align-middle mr-1 mb-3"/>
                        @endif
                        <h1 class="h2">{{ __('Redefinir senha') }}</h1>
                        <p class="lead">
                            Informe uma nova senha
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                {{ html()->form('POST', route('web.admin.password.update'))->open() }}

                                    {{ html()->hidden('token', $token) }}

                                    <div class="form-group">
                                        {{ html()->label(__('E-mail'), 'email') }}
                                        {{ html()->email('email')->class(['form-control', 'form-control-lg', 'is-invalid' => $errors->has('email')])->required(true)->autofocus() }}

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {{ html()->label(__('Nova Senha'), 'password') }}
                                        {{ html()->password('password')->class(['form-control', 'form-control-lg', 'is-invalid' => $errors->has('password')])->required(true) }}

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {{ html()->label(__('Confirmar Senha'), 'password_confirmation') }}
                                        {{ html()->password('password_confirmation')->class(['form-control', 'form-control-lg'])->required(true) }}
                                    </div>

                                    <div class="form-group text-center mb-0">
                                        {{ html()->button(__('Redefinir Senha'), 'submit')->class('btn btn-lg btn-primary') }}
                                    </div>

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
