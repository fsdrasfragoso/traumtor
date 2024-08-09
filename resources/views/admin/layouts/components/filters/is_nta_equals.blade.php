<div class="form-group">
    {{ html()->label(__('Possui NTA?'), 'q[is_nta][equals]') }}
    {{ html()->select('q[is_nta][equals]', trans('models.default.attributes.options.boolean'), request()->input('q.is_nta.equals'))->placeholder('')->class('form-control') }}
</div>
