<div class="form-group">
    {{ html()->label(__('Tipo'), 'q[type][equals]') }}
    {{ html()->select('q[type][equals]', $types, request()->input('q.type.equals'))->placeholder(null)->class('form-control') }}
</div>
