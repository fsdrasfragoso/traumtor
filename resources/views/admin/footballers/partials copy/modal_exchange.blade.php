<div id="modal-exchange" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Troca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ html()->form('POST', route('web.admin.subscriptions.exchange.store'))
                ->data('validation', route('web.admin.subscriptions.exchange.validation'))
                ->open() }}

                <input type="hidden" name="show-modal" value="modal-exchange" />
                <input type="hidden" name="subscription_id" value="{{ $instance->id }}" />

                <div class="modal-body">
                    @component('admin.layouts.components.form.select')
                        @slot('type', \App\Models\Plan::class)
                        @slot('name', 'plan_id')
                        @slot('required', true)
                        @slot('options', (new \App\Repositories\PlanRepository())->selectOptionsForExchange($footballer))
                    @endcomponent
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        var subscription = {!! json_encode($instance->getAttributes()) !!};

        function update_custom_price_visibility(target) {
            var $custom_price_group = $('#custom_price').parents('.form-group');
            if (target.val() == 'custom') {
                $custom_price_group.show();
            } else {
                $custom_price_group.hide();
            }
        }

        var $price_behavior = $('#price_behavior');
        update_custom_price_visibility($price_behavior);

        $price_behavior.change(function (e) {
            var $target = $(e.target);
            update_custom_price_visibility($target);
        });
    });
</script>
@endpush
