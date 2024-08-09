<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[unconfirmed_address]', request()->input('q.unconfirmed_address', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[unconfirmed_address]')]) }}
        {{ html()->label(modelAttribute($type, 'unconfirmed_address'), 'q[unconfirmed_address]')->class('custom-control-label') }}
    </div>
</div>
