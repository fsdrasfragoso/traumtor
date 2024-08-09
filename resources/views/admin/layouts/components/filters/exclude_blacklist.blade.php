<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[exclude_blacklist]', request()->input('q.exclude_blacklist', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[exclude_blacklist]')]) }}
        {{ html()->label(modelAttribute($type, 'exclude_blacklist'), 'q[exclude_blacklist]')->class('custom-control-label') }}
    </div>
</div>
