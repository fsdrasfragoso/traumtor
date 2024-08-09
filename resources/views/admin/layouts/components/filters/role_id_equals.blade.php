<div class="form-group">
    {{ html()->label(modelAttribute($type, 'model_has_roles--role_id'), 'q[model_has_roles--role_id][equals]') }}
    {{ html()->select('q[model_has_roles--role_id][equals]', $rolesForSelect, request()->input('q.model_has_roles--role_id.equals'))->placeholder('')->class('form-control') }}
</div>
