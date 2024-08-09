<div class="modal fade" id="modal-address-update" tabindex="-1" role="dialog" aria-labelledby="modal-address-update-label" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="display: none">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modal-address-update-label">
                    Confirme ou altere seu Endereço!
                </h5>
            </div>
            <div class="modal-body">
                <p class="text-danger">Atenção: alterações futuras no endereço antes da entrega vão causar nova cobrança de frete.</p>

                <h3 class="h3 mb-2 text-center">Endereço de entrega</h3>

                <p>{{$footballer->address->street ?? ''}}, {{$footballer->address->number ?? ''}}, {{$footballer->address->neighborhood ?? ''}},
                    {{$footballer->address->city ?? ''}} - {{$footballer->address->state ?? ''}}, {{$footballer->address->zip_code ?? ''}}</p>

                @component('frontend.layouts.components.form.input_checkbox')
                    @slot('name', 'address-confirmation')
                    @slot('label')
                        <span class="font-size-1x">
                            <b class="mr-2 font-weight-bold">Confirmo que o endereço acima está correto</b>
                        </span>
                    @endslot
                @endcomponent
            </div>
            <div class="modal-footer">
                <button id="confirm-button" type="button" class="btn btn-primary" data-dismiss="modal" disabled>Confirmar</button>
                <a href="{{ route('web.frontend.profiles.edit', ['redirect_url' => url()->current()]) }}"><button type="button" class="btn btn-secondary">Alterar</button></a>
            </div>
        </div>
    </div>
</div>
