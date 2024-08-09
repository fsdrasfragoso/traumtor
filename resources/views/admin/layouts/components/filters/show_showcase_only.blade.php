<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[show_showcase_only]', request()->input('q.show_showcase_only', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[show_showcase_only]')]) }}
        {{ html()->label(modelAttribute($type, 'show_showcase_only'), 'q[show_showcase_only]')->class('custom-control-label') }}
    </div>
</div>
