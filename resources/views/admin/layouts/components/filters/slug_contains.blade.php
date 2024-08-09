<div class="form-group">
    {{ html()->label(__('Slug'), 'q[slug][contains]') }}
    {{ html()->text('q[slug][contains]', request()->input('q.slug.contains'))->class('form-control') }}
</div>
