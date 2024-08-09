@php
$lastPeriod = $instance->periods()->orderBy('cycle', 'desc')->first();
$lastCycle = 1;
if($lastPeriod) {
    $lastCycle = $lastPeriod->cycle;
}
$cycles = [];
for($i=1; $i<=$lastCycle+1; $i++) {
    $cycles[$i] = $i;
}
@endphp
<div id="modal-add-payment" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar fatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ html()->form('POST', $instance->route('payment'))->open() }}

                <input type="hidden" name="show-modal" value="modal-add-payment" />
                <input type="hidden" name="footballer_id" value="{{ $instance->footballer_id }}" />
                <input type="hidden" name="subscription_id" value="{{ $instance->id }}" />

                <div class="modal-body">
                    @component('admin.layouts.components.form.input_text')
                        @slot('type', \App\Models\Payment::class)
                        @slot('name', 'amount')
                        @slot('class', 'mask-currency strip-before-send')
                        @slot('required', true)
                        @slot('prepend', 'R$')
                    @endcomponent

                    @component('admin.layouts.components.form.select')
                        @slot('type', \App\Models\Period::class)
                        @slot('name', 'cycle')
                        @slot('required', true)
                        @slot('options', $cycles)
                    @endcomponent

                    @component('admin.layouts.components.form.input_datetime')
                        @slot('type', \App\Models\Period::class)
                        @slot('name', 'start_at')
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