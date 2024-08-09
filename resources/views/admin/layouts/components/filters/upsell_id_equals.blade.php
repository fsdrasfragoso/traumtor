<div class="form-group">
    {{ html()->label(__('Upgrade'), 'q[upsell_id][equals]') }}
    {{ html()->select('q[upsell_id][equals]', $upsells, request()->input('q.upsell_id.equals'))->placeholder(null)->class('form-control') }}
</div>
