<div class="form-group">
    {{ html()->label(__('Código Externo'), 'q[external_code][contains]') }}
    {{ html()->text('q[external_code][contains]', request()->input('q.external_code.contains'))->class('form-control') }}
</div>
