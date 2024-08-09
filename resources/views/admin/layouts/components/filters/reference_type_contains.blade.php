<div class="form-group">
    {{ html()->label(__('Tipo da Referência'), 'q[reference_type][contains]') }}
    {{ html()->text('q[reference_type][contains]', request()->input('q.reference_type.contains'))->class('form-control') }}
</div>
