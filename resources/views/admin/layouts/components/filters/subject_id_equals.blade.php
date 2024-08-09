<div class="form-group">
    {{ html()->label(modelAttribute($type, 'subject_id'), 'q[subject_id][equals]') }}
    {{ html()->text('q[subject_id][equals]', request()->input('q.subject_id.equals'))->placeholder('')->class('form-control mask-integer') }}
</div>
