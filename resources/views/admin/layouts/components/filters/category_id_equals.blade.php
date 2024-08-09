<div class="form-group">
    {{ html()->label(__('Categoria'), 'q[category_id][equals]') }}
    {{ html()->select('q[category_id][equals]', $categories, request()->input('q.category_id.equals'))->placeholder(null)->class('form-control') }}
</div>
