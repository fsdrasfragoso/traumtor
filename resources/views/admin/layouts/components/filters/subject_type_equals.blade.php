<div class="form-group">
    {{ html()->label(modelAttribute($type, 'subject_type'), 'q[subject_type][equals]') }}
    {{ html()->select('q[subject_type][equals]', $subjectTypes, request()->input('q.subject_type.equals'))->placeholder('')->class('form-control') }}
</div>
