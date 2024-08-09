<div class="modal fade" id="installments-edit" tabindex="-1" role="dialog" aria-labelledby="installments-edit-label"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ html()->form('PUT', $instance->route('installments'))->open() }}
            <div class="modal-header">
                <h5 class="modal-title" id="installments-edit-label">Editar Parcelamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="installments">Novo valor de Parcelamento</label>
                    @component('frontend.layouts.components.form.select')
                        @slot('name', 'installments')
                        @slot('id', 'installments')
                        @slot('value', $instance->installments)
                        @slot('label','')
                        @slot('options', $instance->plan->priceInstallmentsOptions($instance->coupon,$instance->footballer))
                        @slot('required', true)
                    @endcomponent
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
