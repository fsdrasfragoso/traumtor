<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[hide_unpublished]', request()->input('q.hide_unpublished', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[hide_unpublished]')]) }}
        {{ html()->label(modelAttribute($type, 'hide_unpublished'), 'q[hide_unpublished]')->class('custom-control-label') }}
    </div>
</div>