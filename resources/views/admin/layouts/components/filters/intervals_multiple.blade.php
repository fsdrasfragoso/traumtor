@php($a_recurrence = $recurrence->toArray())
@php(asort($a_recurrence))
<div class="form-group">
    {{ html()->label(__('Recorrência'), 'q[recurrence]') }}
    {{ html()->multiselect('q[recurrence]', $a_recurrence, request()->input('q.recurrence'))
        ->id('recurrence')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#recurrence').select2();
			});
        </script>
    @endpush
</div>
