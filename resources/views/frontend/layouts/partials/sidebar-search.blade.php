<nav id="sidebar-search" class="sidebar sidebar--right sidebar--light {{ user() ? 'sidebar--with-admin' : '' }}" style="position: initial; height: auto;">
    <div class="sidebar__drop"></div>
    <div class="sidebar__container">
        <div class="form">
            {{ html()->form('GET', route('web.frontend.default.index'))->id('form-search-m')->open() }}
                <div class="d-block d-lg-none search-mobile">
                    <div class="d-flex flex-column">
                        <label class="m-0 font-weight-bold"><i class="fa fa-search"></i> Pesquisar por:</label>
                        <input type="text" name="q" value="{{ getSearchQuery() }}">
                        <span class="search-mobile__custom-placeholder">Exemplo: renda fixa, bolsa, fundos</span>
                    </div>

                    @include('frontend.layouts.partials.mobile-filters')

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary btn-block my-3 text-uppercase">{{ __('Mostrar resultados') }}</button>
                    </div>
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</nav>
