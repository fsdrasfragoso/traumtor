<div class="form-group">
    {{ html()->label(__('ID'), 'q[id][equals]') }}
    {{ html()->text('q[id][equals]', request()->input('q.id.equals'))->class('form-control mask-integer') }}
</div>
