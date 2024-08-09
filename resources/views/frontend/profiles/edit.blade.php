@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\Profile $profile
 * @var \App\Models\Address $address
 */
@endphp

@extends('frontend.layouts.template')

@section('title', title(__('Editar meu perfil')))

@section('main-nav')
    @include('frontend.layouts.partials.sections.profiles-main-nav')
@endsection

@section('content')

    <main class="main-content d-flex flex-column">

        <div class="default-container input-profile">

            <div class="d-none d-lg-flex flex-column">
                <div class="flex-column aside-subscriber-area">
                    <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
                        Minha área
                    </span>
                    @include('frontend.layouts.partials.sections.subscriber-area-aside')
                </div>
            </div>

            <div>

                <div id="accordion" class="accordion--profile">
                    <div class="card mb-3 rounded-sm position-relative overflow-hidden full-card">
                        <div class="card-header rounded-sm card-shadow d-flex justify-content-between align-items-center" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span>Dados Pessoais e Endereço</span>
                            <i class="fal fa-angle-up fa-2x ml-1"></i>
                        </div>

                        <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                {{ html()->modelForm($footballer, 'PUT', route('web.frontend.profiles.update', ['redirect_url' => request('redirect_url')]))->id('footballer-form')->acceptsFiles()->open() }}

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group d-flex flex-column m-0">
                                            <label class="p-0 m-0" for="name">Nome</label>
                                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('name', $footballer->name) }}" name="name" id="name" required>
                                        </div>
                                        <hr class="separator d-lg-none p-0 m-0" />
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group d-flex flex-column m-0">
                                            <label class="p-0 m-0" for="document">CPF</label>
                                            <label class="font-weight-bold mb-0">{{ old('document', $footballer->document) }}</label>
                                        </div>
                                        <hr class="separator d-lg-none p-0 m-0" />
                                    </div>

                                </div>

                                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group d-flex flex-column m-0">
                                            <label class="p-0 m-0" for="mobile">Telefone</label>
                                            <input class="mask-phone" style="background: none; border: none; outline: none" type="text" value="{{ old('phone', $footballer->phone) }}" name="phone" id="phone" required>
                                        </div>
                                        <hr class="separator d-lg-none p-0 m-0" />
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group d-flex flex-column m-0">
                                            <label class="p-0 m-0" for="email">E-mail</label>
                                            <input style="background: none; border: none; outline: none" type="email" value="{{ old('email', $footballer->email) }}" name="email" id="email" required>
                                        </div>
                                        <hr class="separator d-lg-none p-0 m-0" />
                                    </div>

                                </div>

                                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                <h3 class="h4 mb-3 mt-3">Endereço</h3>

                                <div class="form-address">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="zip_code">CEP</label>
                                                <input style="background: none; border: none; outline: none" type="text" value="{{ $address->zip_code }}" name="zip_code" id="zip_code" required>
                                            </div>
                                            <hr class="separator d-lg-none p-0 m-0" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="street">Rua</label>
                                                <input style="background: none; border: none; outline: none" type="text" value="{{ $address->street }}" name="street" id="street" required>
                                            </div>
                                            <hr class="separator d-lg-none p-0 m-0" />
                                        </div>

                                    </div>
                                    <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="number">Número</label>
                                                <input style="background: none; border: none; outline: none" type="text" value="{{ $address->number }}" name="number" maxlength="9" id="number" required>
                                            </div>
                                            <hr class="separator d-lg-none p-0 m-0" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="neighborhood">Bairro</label>
                                                <input style="background: none; border: none; outline: none" type="text" value="{{ $address->neighborhood }}" name="neighborhood" id="neighborhood" required>
                                            </div>
                                            <hr class="separator d-lg-none p-0 m-0" />
                                        </div>

                                    </div>

                                    <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="complement">Complemento</label>
                                                <input style="background: none; border: none; outline: none" type="text" value="{{ $address->complement }}" name="complement" id="complement">
                                            </div>
                                            <hr class="separator d-lg-none p-0 m-0" />
                                        </div>
                                    </div>
                                    <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group d-flex flex-column m-0">
                                                <label class="p-0 m-0" for="state">Estado</label>
                                                @component('frontend.layouts.components.form.select')
                                                    @slot('name', 'state')
                                                    @slot('label', 'Estado')
                                                    @slot('class', 'input-select bg-white pl-0')
                                                    @slot('value', $address->state)
                                                    @slot('options', \App\Models\Footballer::stateOptions())
                                                    @slot('required', true)
                                                @endcomponent
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="p-0 m-0" for="city">Cidade</label>
                                            @component('frontend.layouts.components.form.input_text')
                                                @slot('name', 'city')
                                                @slot('label', 'Cidade')
                                                @slot('class', 'pl-0 border-0 bg-transparent shadow-none')
                                                @slot('value', $address->city)
                                                @slot('required', true)
                                            @endcomponent
                                        </div>
                                    </div>

                                    <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                                </div>

                                <div class="form-group btn-sub mt-3 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Alterar Dados
                                    </button>
                                </div>

                                {{ html()->closeModelForm() }}
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 rounded-sm position-relative overflow-hidden full-card">
                        <div class="card-header rounded-sm card-shadow d-flex justify-content-between align-items-center" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span>Meus Cartões</span>
                            <i class="fal fa-angle-down fa-2x ml-1"></i>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">


                            <div class="card-body">

                                @if($paymentProfiles->isNotEmpty() && !$footballer->hide_creditcard)
                                    <div class="card mb-4">
                                        @foreach($paymentProfiles as $paymentProfile)
                                            <label for="radio-{{ $paymentProfile->id }}" class="mb-0">
                                                <div class="card-body rounded-sm d-flex flex-column p-2 credit-card {{ $paymentProfile->is_current ? 'active' : '' }}" data-id="{{ $paymentProfile->id }}" style="background-color: #fff !important; color: #000">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            #{{ $loop->index + 1 }}
                                                            <img src="/img/admin/flags/flag-{{ $paymentProfile->flag }}.png" />
                                                            {{ $paymentProfile->serial }} ({{ $paymentProfile->getMethodName() }})
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input
                                                                id="radio-{{ $paymentProfile->id }}"
                                                                type="radio"
                                                                value="{{ $paymentProfile->id }}"
                                                                name="card-selected"
                                                                {{ $paymentProfile->is_current ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif

                                {{ html()
                                    ->modelForm($footballer, 'PUT', route('web.frontend.payment_profiles.update'))
                                    ->id('credit-card-form')
                                    ->acceptsFiles()
                                    ->open() }}

                                <div class="row">

                                    <div class="col-md-8 pl-1 pr-1 pb-1">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                @component('frontend.layouts.components.form.input_text')
                                                    @slot('name', 'serial')
                                                    @slot('id', 'credit_card_serial')
                                                    @slot('classParent', 'shadow-sm')
                                                    @slot('label', 'Número do cartão')
                                                    @slot('placeholder', 'Número do cartão')
                                                    @slot('value', '')
                                                    @slot('class', 'mask-creditcard strip-before-send')
                                                    @slot('attributes', [
                                                        'autocomplete' => 'cc-number',
                                                        'data-flag' => '#credit_card_flag',
                                                    ])
                                                    @slot('required', true)
                                                @endcomponent
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 pl-1 pl-md-0 pr-1 pb-1">
                                        @component('frontend.layouts.components.form.select')
                                            @slot('name', 'flag')
                                            @slot('id', 'credit_card_flag')
                                            @slot('classParent', 'shadow-sm')
                                            @slot('placeholder', 'Bandeira' )
                                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::flagOptions())
                                            @slot('required', true)
                                        @endcomponent
                                    </div>

                                    <div class="col-md-8 pl-1 pr-1 pb-1">
                                        @component('frontend.layouts.components.form.input_text')
                                            @slot('name', 'holder')
                                            @slot('id', 'credit_card_holder')
                                            @slot('classParent', 'shadow-sm')
                                            @slot('label', 'Titular do cartão')
                                            @slot('placeholder', 'Titular do cartão')
                                            @slot('attributes', [
                                                'autocomplete' => 'cc-name',
                                            ])
                                            @slot('required', true)
                                        @endcomponent
                                    </div>

                                    <div class="col-md-4 pl-1 pl-md-0 pr-1 pb-1">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                @component('frontend.layouts.components.form.input_text')
                                                    @slot('name', 'cvv')
                                                    @slot('id', 'credit_card_cvv')
                                                    @slot('classParent', 'shadow-sm')
                                                    @slot('label', 'CVV')
                                                    @slot('placeholder', 'CVV')
                                                    @slot('attributes', [
                                                        'autocomplete' => 'cc-csc',
                                                    ])
                                                    @slot('required', true)
                                                @endcomponent
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 pl-1 pr-1 pb-1">
                                        @component('frontend.layouts.components.form.select')
                                            @slot('name', 'month')
                                            @slot('id', 'credit_card_month')
                                            @slot('classParent', 'shadow-sm')
                                            @slot('placeholder', 'Mês' )
                                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::monthOptions())
                                            @slot('attributes', [
                                                'autocomplete' => 'cc-exp_month',
                                            ])
                                            @slot('required', true)
                                        @endcomponent
                                    </div>
                                    <div class="col-md-6 pl-1 pl-md-0 pr-1 pb-1">
                                        @component('frontend.layouts.components.form.select')
                                            @slot('name', 'year')
                                            @slot('id', 'credit_card_year')
                                            @slot('classParent', 'shadow-sm')
                                            @slot('class', 'select-card')
                                            @slot('placeholder', 'Ano' )
                                            @slot('options', \App\Libraries\PaymentGateway\CreditCard::yearOptions())
                                            @slot('attributes', [
                                                'autocomplete' => 'cc-exp-year',
                                            ])
                                            @slot('required', true)
                                        @endcomponent
                                    </div>

                                </div>
                                <div class="form-group btn-sub mt-3 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Alterar Cartão
                                    </button>
                                </div>

                                {{ html()->closeModelForm() }}
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 rounded-sm position-relative overflow-hidden full-card">
                        <div class="card-header rounded-sm card-shadow d-flex justify-content-between align-items-center" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span>Alterar Senha</i></span>
                            <i class="fal fa-angle-down fa-2x ml-1"></i>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                {{ html()->form('POST', route('web.frontend.password.change'))->open() }}

                                @component('frontend.layouts.components.form.input_password')
                                    @slot('name', 'old_password')
                                    @slot('label', 'Senha atual')
                                    @slot('class', 'pb-1')
                                    @slot('placeholder', 'Senha atual')
                                    @slot('required', true)
                                @endcomponent

                                @component('frontend.layouts.components.form.input_password')
                                    @slot('name', 'password')
                                    @slot('label', 'Nova Senha')
                                    @slot('class', 'pb-1')
                                    @slot('placeholder', 'Nova Senha')
                                    @slot('required', true)
                                @endcomponent

                                @component('frontend.layouts.components.form.input_password')
                                    @slot('name', 'password_confirmation')
                                    @slot('label', 'Confirmar Senha')
                                    @slot('class', 'pb-1')
                                    @slot('placeholder', 'Confirmar Senha')
                                    @slot('required', true)
                                @endcomponent

                                <div class="form-group btn-sub mt-3 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Alterar Senha
                                    </button>
                                </div>

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block">
                @include('frontend.layouts.partials.sections.profiles-aside-right')
            </div>
        </div>
    </main>
@endsection
