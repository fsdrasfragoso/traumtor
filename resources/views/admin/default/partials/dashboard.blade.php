<div class="row">
    <div class="col-12 col-sm-6 col-xl d-flex">
        @include('admin.default.partials.subscription_liquid_sale')
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        @include('admin.default.partials.subscription_report')
    </div>
</div>

@push('scripts')
<script>

$(function() {
	const callData = () => {
        let checkboxAutoReload = document.getElementById('auto-reload');

        if (checkboxAutoReload.checked == true) {
            setTimeout(function () {
                if (! document.getElementById('dashboard-content')) {
                    return;
                }
                $.pjax.reload({ container: '#dashboard-content' });
                callData();
            }, 1000 * 60 * 5);
        }
    };

    callData();
});

</script>
@endpush
