<div class="form-group">
    {{ html()->label(__('Tipo'), 'q[type][contains]') }}
    {{ html()->text('q[type][contains]', request()->input('q.type.contains'))->placeholder(null)->class('form-control') }}
</div>
