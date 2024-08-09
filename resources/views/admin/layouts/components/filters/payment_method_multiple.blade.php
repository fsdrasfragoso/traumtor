<div class="form-group">
    {{ html()->label(__($title ?? 'Forma de pagamento'), $id ?? 'q[payment_methods]') }}
    {{ html()->multiselect($id ?? 'q[payment_methods]', config('paymentgateway.methods'), request()->input($name ?? 'q.payment_methods'))
        ->id($id_select ?? 'payment_methods')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('{{ isset($id_select) ? '#'.$id_select :  '#payment_methods' }}').select2();
			});
        </script>
    @endpush
</div>
