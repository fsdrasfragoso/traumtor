<div class="form-group">
    {{ html()->label(modelAttribute($type, 'folder_id'), 'q[folder_id][equals]') }}
    {{ html()->select('q[folder_id][equals]', $folders, request()->input('q.folder_id.equals'))->placeholder('')->class('form-control') }}
</div>
