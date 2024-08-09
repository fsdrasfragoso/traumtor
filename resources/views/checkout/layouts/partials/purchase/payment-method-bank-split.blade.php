<div class="card">
    <div class="card-header">
        <button class="btn btn-link btn-block {{ $paymentMethod == 'bank_split' && $paymentGateway == 'asaas' ? '' : 'collapsed' }}" data-toggle="collapse" data-target=".payment-method.bank_split">
            <span class="icon mr-1"><i class="fal fa-check"></i></span>
            <span class="text mr-1">
                Boleto Bancário
            </span>
            <span class="flags">
                <i class="far fa-exchange"></i>
            </span>
        </button>
    </div>
    <div class="card-body payment-method bank_split fade collapse {{ $paymentMethod == 'bank_split' && $paymentGateway == 'asaas' ? 'show' : '' }}"  data-parent="#payment">
        {{ html()->form('POST', $store_url)->open() }}

        <input type="hidden" name="payment_method" value="bank_split" />
        <input type="hidden" name="payment_gateway" value="asaas" />
        <input type="hidden" name="installments" value="1" />

        <div class="font-family-secondary">
            <p>
                Olá, {{ data_get(explode(" ", $footballer->name), 0) }}!
            </p>

            <p>
                Ao apertar em finalizar compra, você será redirecionado para uma tela onde poderá baixar o seu boleto e realizar o pagamento do seu livro.
            </p>

            <p class="mb-3 mt-3 font-weight-bold">
                Valor: {{ moneyFormat($price) }}
            </p>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group mt-1 mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase {{ user() ? '' : 'confirm-purchase' }}">
                       Finalizar compra
                    </button>
                </div>
            </div>
        </div>

        {{ html()->form()->close() }}
    </div>
</div>
