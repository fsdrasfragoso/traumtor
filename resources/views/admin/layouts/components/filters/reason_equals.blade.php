<div class="form-group">
    {{ html()->label(__('Razão'), 'q[reason][equals]') }}
    {{ html()->select('q[reason][equals]', $reasons, request()->input('q.reason.equals'))->placeholder(null)->class('form-control') }}
</div>
