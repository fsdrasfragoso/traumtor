<div class="form-group">
    {{ html()->label(__('Cupons'), 'q[coupons]') }}
    {{ html()->multiselect('q[coupons]', $coupons, request()->input('q.coupons'))
        ->id('coupons')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#coupons').select2();
			});
        </script>
    @endpush
</div>
