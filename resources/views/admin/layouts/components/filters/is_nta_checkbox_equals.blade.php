<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[is_nta]', request()->input('q.is_nta', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[is_nta]')]) }}
        {{ html()->label(modelAttribute($type, 'is_nta'), 'q[is_nta]')->class('custom-control-label') }}
    </div>
</div>
