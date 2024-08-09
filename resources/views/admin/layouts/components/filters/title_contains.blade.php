<div class="form-group">
    {{ html()->label(modelAttribute($type, 'title'), 'q[title][contains]') }}
    {{ html()->text('q[title][contains]', request()->input('q.title.contains'))->class('form-control') }}
</div>
