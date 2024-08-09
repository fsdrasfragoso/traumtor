<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[activation]', request()->input('q.activation', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[activation]')]) }}
        {{ html()->label(modelAttribute($type, 'activation'), 'q[activation]')->class('custom-control-label') }}
    </div>
</div>
