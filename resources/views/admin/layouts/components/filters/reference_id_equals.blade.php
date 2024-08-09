<div class="form-group">
    {{ html()->label(__('Id da Referência'), 'q[reference_id][equals]') }}
    {{ html()->text('q[reference_id][equals]', request()->input('q.reference_id.equals'))->class('form-control') }}
</div>
