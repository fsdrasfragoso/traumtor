<div class="form-group">
    {{ html()->label(__('Futebolista'), 'q[footballer_id][equals]') }}
    {{ html()->text('q[footballer_id][equals]', request()->input('q.footballer_id.equals'))->class('form-control mask-integer') }}
</div>
