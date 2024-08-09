<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[allow_footballers_repeated]', request()->input('q.allow_footballers_repeated', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[allow_footballers_repeated]')]) }}
        {{ html()->label(modelAttribute($type, 'allow_footballers_repeated'), 'q[allow_footballers_repeated]')->class('custom-control-label') }}
    </div>
</div>
