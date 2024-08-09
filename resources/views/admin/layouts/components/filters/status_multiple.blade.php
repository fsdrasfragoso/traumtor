@php($a_status = $statuses->toArray())
@php(asort($a_status))
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Status'), isset($id) ? 'q['.$id.']' : 'q[status]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[status]', $a_status, request()->input(isset($id) ? 'q.'.$id : 'q.status'))
        ->id('status')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#status').select2();
			});
        </script>
    @endpush
</div>
