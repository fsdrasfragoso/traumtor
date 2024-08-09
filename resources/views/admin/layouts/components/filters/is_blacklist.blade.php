<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[is_blacklist]', request()->input('q.is_blacklist', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[is_blacklist]')]) }}
        {{ html()->label(modelAttribute($type, 'is_blacklist'), 'q[is_blacklist]')->class('custom-control-label') }}
    </div>
</div>
