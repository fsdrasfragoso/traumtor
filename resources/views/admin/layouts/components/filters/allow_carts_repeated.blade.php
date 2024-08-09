<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[allow_carts_repeated]', request()->input('q.allow_carts_repeated', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[allow_carts_repeated]')]) }}
        {{ html()->label(modelAttribute($type, 'allow_carts_repeated'), 'q[allow_carts_repeated]')->class('custom-control-label') }}
    </div>
</div>
