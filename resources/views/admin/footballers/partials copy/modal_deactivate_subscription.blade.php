<div class="modal fade" id="deactivate-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ html()->form('DELETE', $instance->route('deactivate'))->open() }}
            <div class="modal-content bg-status-active_wr text-white">
                <div class="modal-header border-secondary">
                    <h4 class="modal-title text-white text-center mx-auto" id="exampleModalLabel">
                        Tem certeza que deseja desativar a assinatura? <br>
                        Isso irá desativar a renovação da série
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close p-0 m-0">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @component('admin.layouts.components.form.input_datetime')
                        @slot('label', 'Data de desativação')
                        @slot('name', 'canceled_at')
                        @slot('value', now()->format('d/m/Y H:i'))
                    @endcomponent

                    @component('admin.layouts.components.form.select')
                        @slot('label', 'Motivo da Desativação')
                        @slot('name', 'reasons')
                        @slot('options', modelAttribute(\App\Models\Subscription::class, 'reasons.deactivation'))
                    @endcomponent

                    @component('admin.layouts.components.form.input_textarea')
                        @slot('label', 'Observações')
                        @slot('name', 'observations')
                    @endcomponent
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary bg-danger text-white border-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary bg-danger text-white border-secondary">Salvar desativação</button>
                </div>
            </div>
        {{ html()->form()->close() }}
    </div>
</div>
