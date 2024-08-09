<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[is_active]', request()->input('q.is_active', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[is_active]')]) }}
        {{ html()->label(modelAttribute($type, 'is_active'), 'q[is_active]')->class('custom-control-label') }}
    </div>
</div>
