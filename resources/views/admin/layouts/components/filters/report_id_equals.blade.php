<div class="form-group">
    {{ html()->label(__('Relatório'), 'q[report_id][equals]') }}
    {{ html()->select('q[report_id][equals]', $reports, request()->input('q.report_id.equals'))->placeholder(null)->class('form-control') }}
</div>
