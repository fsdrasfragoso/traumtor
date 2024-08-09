<nav id="sidebar-top-contents" class="sidebar sidebar--right sidebar--light {{ user() ? 'sidebar--with-admin' : '' }}">
    <div class="sidebar__drop"></div>
    <div class="sidebar__container">
        <div class="col-12">
            @include('frontend.layouts.partials.sections.default-aside-right', [
                'isNotAside' => true
            ])
        </div>
    </div>
</nav>
