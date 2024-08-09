<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ html()->form('DELETE', $instance->route('cancel'))->open() }}
            <div class="modal-content bg-danger text-white">
                <div class="modal-header border-secondary">
                    <h4 class="modal-title text-white text-center mx-auto" id="exampleModalLabel">
                        Tem certeza que deseja cancelar a assinatura? <br>
                        Isso irá cancelar o acesso do usuário
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close p-0 m-0">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.subscriptions.partials.cancellation_form')
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary bg-danger text-white border-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary bg-danger text-white border-secondary">Salvar cancelamento</button>
                </div>
            </div>
        {{ html()->form()->close() }}
    </div>
</div>

@push('scripts')
    <script>
        const CANCELLATION_TYPE_REAL = '{{ \App\Models\Subscription::CANCELLATION_TYPE_REAL }}';

        $(document).on('change', 'select[name=cancellation_type]', function() {
            if(this.value === CANCELLATION_TYPE_REAL){
                $('.hide-on-test').removeClass('d-none');
            } else {
                $('.hide-on-test').addClass('d-none');
            }
        });

        $('select[name=cancellation_type]').change();
    </script>
@endpush
