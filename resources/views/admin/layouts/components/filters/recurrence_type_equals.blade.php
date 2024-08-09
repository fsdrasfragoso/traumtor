@php($a_options = $options->toArray())
@php(asort($a_options))

<div class="form-group">
    {{ html()->label(__('Recorrência'), 'q[recurrence][equals]') }}
    {{ html()->select('q[recurrence][equals]', $a_options, request()->input('q.recurrence.equals'))->placeholder('')->class('form-control') }}
</div>