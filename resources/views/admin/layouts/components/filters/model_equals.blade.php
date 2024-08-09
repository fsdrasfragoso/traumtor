<div class="form-group">
    {{ html()->label(__('Seção'), 'q[model][equals]') }}
    {{ html()->select('q[model][equals]', $models, request()->input('q.model.equals'))->placeholder(null)->class('form-control') }}
</div>
