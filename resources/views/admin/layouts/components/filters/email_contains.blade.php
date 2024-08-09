<div class="form-group">
    {{ html()->label(__('E-mail'), 'q[email][contains]') }}
    {{ html()->text('q[email][contains]', request()->input('q.email.contains'))->class('form-control') }}
</div>
