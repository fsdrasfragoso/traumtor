<div class="form-group">
    {{ html()->label(__($title ?? 'Estados'), $id ?? 'q[states]') }}
    {{ html()->multiselect($id ?? 'q[states]', modelAttribute(Address::class, 'options.state'), request()->input($name ?? 'q.states'))
        ->id($id_select ?? 'states')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('{{ isset($id_select) ? '#'.$id_select :  '#states' }}').select2();
			});
        </script>
    @endpush
</div>
