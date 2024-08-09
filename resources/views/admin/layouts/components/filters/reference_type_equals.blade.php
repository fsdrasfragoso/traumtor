<div class="form-group">
    {{ html()->label(__('Tipo da Referência'), 'q[reference_type][equals]') }}
    {{ html()->select('q[reference_type][equals]', $options, request()->input('q.reference_type.equals'))->placeholder(null)->class('form-control') }}
</div>
