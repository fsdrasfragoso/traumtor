<div class="form-group">
    {{ html()->label(modelAttribute($type, 'action'), 'q[description][equals]') }}
    {{ html()->select('q[description][equals]', $actions, request()->input('q.description.equals'))->placeholder('')->class('form-control') }}
</div>
