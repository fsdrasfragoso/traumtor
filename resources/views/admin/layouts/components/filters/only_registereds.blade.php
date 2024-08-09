<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_registereds]', request()->input('q.only_registereds', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_registereds]')]) }}
        {{ html()->label(modelAttribute($type, 'only_registereds'), 'q[only_registereds]')->class('custom-control-label') }}
    </div>
</div>
