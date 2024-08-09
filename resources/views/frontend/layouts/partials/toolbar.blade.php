<div class="toolbar">

    <nav class="toolbar-nav">
        <a class="toolbar-item {{ url()->current() === route('web.frontend.default.index') ? 'is-active' : ''  }}" href="{{ route('web.frontend.default.index') }}" data-pjax="#main">
            <i class="fas fa-home"></i>
            <span class="navlabel">
                Início
            </span>
        </a>
    </nav>
</div>

@push('scripts')
    <script>
        $(function () {
            var page = $('.toolbar-item.is-active')[0];

            $(document).on('click', '[data-toggle="sidebar"]', function () {
                var activeToolbarItems = $('.toolbar-item.is-active')[0];
                $(activeToolbarItems).removeClass('is-active');
                $(page).removeClass('is-active');
                if (!activeToolbarItems) {
                    $(page).addClass('is-active');
                    return;
                }
            });
        })
    </script>
@endpush
