<div class="form__filters mx-2">
    <i class="fa fa-times" id="filter-hide"></i>
    <div class="row">
        <div class="col-md-9 px-0">
            <div class="form-group mt-2">
                <div class="input-group">
                    {{ html()->text('q', getSearchQuery())->class(['form-control', 'order-1'])->placeholder('Pesquisar') }}
                    <span class="input-group-prepend order-0 d-none d-md-flex">
                        <span class="input-group-text"><i class="fal fa-search"></i></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pr-0">
            <div class="h-100 d-flex align-items-center">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">{{ __('Buscar') }}</button>
            </div>
        </div>
        <div class="col-md-3 px-0">
            <div class="form__search-select">
                <label>{{ __('Ordernar por') }}</label>
                <i class="fa fa-chevron-down"></i>
                {{ html()->select('order_by', [
                    'desc'  => __('Mais recente'),
                    'asc'   => __('Mais antigas'),
                ], Cookie::get('order_by'))->class(['form-control is-cookie']) }}
            </div>
        </div>
        <div class="col-md-3 pr-0">
            <div class="form__search-select">
                <label>{{ __('Formato de conteúdo') }}</label>
                <i class="fa fa-chevron-down"></i>
                {{ html()->select('content_format', [
                    ''            => __('Todos'),
                    'video'       => __('Vídeo'),
                    'document'    => __('Texto'),
                    'audio'       => __('Aúdio'),
                    'spreadsheet' => __('Planilhas'),
                ], Cookie::get('content_format'))->class(['form-control is-cookie']) }}
            </div>
        </div>
        <div class="col-md-3 pr-0">
            <div class="form__search-select">
                <label>{{ __('Tipo de conteúdo') }}</label>
                <i class="fa fa-chevron-down"></i>
                {{ html()->select('content_paid', [
                    ''      => __('Todos'),
                    'paid'  => __('Pago'),
                    'free'  => __('Gratuito'),
                ], Cookie::get('content_paid'))->class(['form-control is-cookie']) }}
            </div>
        </div>
        <div class="col-md-3 pr-0">
            <div class="form__search-select">
                <label>{{ __('Data e quantidade') }}</label>
                <i class="fa fa-chevron-down"></i>
                {{ html()->select('content_period', [
                    ''          => __('Todos os conteúdos'),
                    '7-period'  => __('Últimos 7 dias'),
                    '30-period' => __('Últimos 30 dias'),
                    // 'd'      => __('Todas as datas'),
                    '3-limit'   => __('Últimos 3 conteúdos'),
                    '10-limit'  => __('Últimos 10 conteúdos'),
                ], Cookie::get('content_period'))->class(['form-control is-cookie']) }}
            </div>
        </div>
    </div>
</div>
