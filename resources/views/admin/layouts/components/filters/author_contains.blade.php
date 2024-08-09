<div class="form-group">
    {{ html()->label(modelAttribute($type, 'author'), 'q[author][contains]') }}
    {{ html()->text('q[author][contains]', request()->input('q.author.contains'))->class('form-control') }}
</div>
