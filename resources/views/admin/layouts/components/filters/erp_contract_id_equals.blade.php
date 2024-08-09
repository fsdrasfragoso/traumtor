<div class="form-group">
    {{ html()->label(__('Contrato'), 'q[erp_contract_id][equals]') }}
    {{ html()->text('q[erp_contract_id][equals]', request()->input('q.erp_contract_id.equals'))->class('form-control mask-integer') }}
</div>
