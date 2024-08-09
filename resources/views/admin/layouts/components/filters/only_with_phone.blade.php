<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_with_phone]', request()->input('q.only_with_phone', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_with_phone]')]) }}
        {{ html()->label(modelAttribute($type, 'only_with_phone'), 'q[only_with_phone]')->class('custom-control-label') }}
    </div>
</div>
