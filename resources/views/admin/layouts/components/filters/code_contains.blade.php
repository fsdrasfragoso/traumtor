<div class="form-group">
    {{ html()->label(__('Code'), 'q[code][contains]') }}
    {{ html()->text('q[code][contains]', request()->input('q.code.contains'))->class('form-control') }}
</div>
