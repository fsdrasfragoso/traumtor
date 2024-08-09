@php($a_status = $statuses->toArray())
@php(asort($a_status))

<div class="form-group">
    {{ html()->label(__($label ?? 'Status'), 'q[status][equals]') }}
    {{ html()->select('q[status][equals]', $a_status, request()->input('q.status.equals'))->placeholder('')->class('form-control') }}
</div>
