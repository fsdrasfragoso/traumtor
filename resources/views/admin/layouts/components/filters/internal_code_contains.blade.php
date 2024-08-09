<div class="form-group">
    {{ html()->label(__('Código Interno'), 'q[internal_code][contains]') }}
    {{ html()->text('q[internal_code][contains]', request()->input('q.internal_code.contains'))->class('form-control') }}
</div>
