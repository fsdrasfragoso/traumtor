<div class="form-group">
    {{ html()->label(__('Nome do arquivo'), 'q[file_name][contains]') }}
    {{ html()->text('q[file_name][contains]', request()->input('q.file_name.contains'))->class('form-control') }}
</div>
