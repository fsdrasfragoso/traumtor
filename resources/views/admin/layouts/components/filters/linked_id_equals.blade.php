<div class="form-group">
    {{ html()->label(__('Vinculada'), 'q[linked_id][equals]') }}
    {{ html()->select('q[linked_id][equals]', $linkeds, request()->input('q.linked_id.equals'))->placeholder(null)->class('form-control') }}
</div>
