<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_consent]', request()->input('q.only_consent', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_consent]')]) }}
        {{ html()->label(modelAttribute($type, 'only_consent'), 'q[only_consent]')->class('custom-control-label') }}
    </div>
</div>
