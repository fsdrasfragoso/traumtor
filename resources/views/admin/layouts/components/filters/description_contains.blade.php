<div class="form-group">
    {{ html()->label(modelAttribute($type, 'description'), 'q[description][contains]') }}
    {{ html()->text('q[description][contains]', request()->input('q.description.contains'))->class('form-control') }}
</div>
