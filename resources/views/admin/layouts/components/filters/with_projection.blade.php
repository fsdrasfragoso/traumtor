<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[with_projection]', request()->input('q.with_projection', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[with_projection]')]) }}
        {{ html()->label(modelAttribute($type, 'with_projection'), 'q[with_projection]')->class('custom-control-label') }}
    </div>
</div>
