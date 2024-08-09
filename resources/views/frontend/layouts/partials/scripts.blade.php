<script>
    $(function() {
        initAside();
        initBootstrap();
        initFormAddress();
        initFormSelectFloatingLabel();
        initFormValidation();
        initDatetimepicker();
        initMask();
        initMenuActive();
        updateRedirectUrl("{!!  url()->full() !!}");
    });

</script>

@include('frontend.layouts.partials.load-scripts.notifications')

@yield('scripts')
@stack('scripts')
