<div class="form-group">
    {{ html()->label(__('Publicado?'), 'q[is_published]') }}
    {{ html()->select('q[is_published]', trans('models.default.attributes.options.boolean'), request()->input('q.is_published'))->placeholder('')->class('form-control') }}
</div>
