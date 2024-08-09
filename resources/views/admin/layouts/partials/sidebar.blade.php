@php
    $menu = config('admin.menu');
@endphp

<nav class="sidebar sidebar-sticky" role="navigation">
    <div class="sidebar-content js-simplebar">
        <div class="sidebar-head">
            <div class="row">
                <div class="side-brand col d-flex align-items-center">
                    <a class="sidebar-brand" href="{{ route('web.admin.default.show') }}">
                        @if(config('admin.icon'))
                            <img src="{{ config('admin.icon') }}" style="width: 100%;" class="align-middle mr-1"/>
                        @endif
                    </a>
                </div>
                <div class="col d-flex align-items-center justify-content-end d-block d-lg-none mr-2">
                    <a href="#" class="sidebar-toggle d-flex" style="text-decoration: none;">
                        <i class="fal fa-times align-self-center" style="font-size:1.5rem; color:#017A7E"></i>
                    </a>
                </div>
            </div>

            <div class="sidebar-search">
                <input class="form-control sidebar-search-input" placeholder="Buscar menu (Ctrl + B)" autocomplete="off" name="sidebar-search-input" type="text">
            </div>
        </div>

        @component('admin.layouts.components.sidebar_nav')

            @foreach($menu as $key => $section)
                @if(data_get($section, 'header') && canAdminSection($section))
                    @component('admin.layouts.components.sidebar_nav_header')
                    <span class="text-previous">
                        {{ __(data_get($section, 'header')) }}
                    </span>
                    @endcomponent
                @endif

                @foreach(data_get($section, 'items') as $item)
                    @if(data_get($item, 'items'))
                        @php
                            $policy = false;
                            foreach(data_get($item, 'items.*.policy') as $item_policy) {
                                if (user()->can(...$item_policy)) {
                                    $policy = true;
                                    break;
                                }
                            }
                        @endphp

                        @component('admin.layouts.components.sidebar_nav_submenu')
                            @slot('policy', $policy)
                            @slot('id', data_get($item, 'id'))
                            @slot('icon', data_get($item, 'icon'))
                            @slot('label', data_get($item, 'setting_label') ? settings(data_get($item, 'setting_label'), __(data_get($item, 'label'))) : __(data_get($item, 'label')))

                            @php($active = false)
                            @foreach(data_get($item, 'items') as $subitem)
                                @component('admin.layouts.components.sidebar_nav_subitem')
                                    @slot('policy', data_get($subitem, 'policy') ? user()->can(...data_get($subitem, 'policy')) : true)
                                    @slot('url', data_get($subitem, 'route') ? route(data_get($subitem, 'route')) : data_get($subitem, 'link'))
                                    @slot('icon', data_get($subitem, 'icon'))
                                    @slot('label', __(data_get($subitem, 'label')))
                                    @slot('pjax', __(data_get($subitem, 'pjax', true)))
                                    @slot('active', sameRoutePrefix(data_get($subitem, 'route')))
                                @endcomponent
                                @if(sameRoutePrefix(data_get($subitem, 'route')))
                                    @php($active = true)
                                @endif
                            @endforeach

                            @if($active)
                                @slot('active', true)
                            @endif

                        @endcomponent
                    @else
                        @component('admin.layouts.components.sidebar_nav_item')
                            @slot('policy', data_get($item, 'policy') ? user()->can(...data_get($item, 'policy')) : true)
                            @slot('url', data_get($item, 'route') ? route(data_get($item, 'route')) : data_get($item, 'link'))
                            @slot('icon', data_get($item, 'icon'))
                            @slot('label', data_get($item, 'setting_label') ? settings(data_get($item, 'setting_label'), __(data_get($item, 'label'))) : __(data_get($item, 'label')))
                            @slot('pjax', __(data_get($item, 'pjax', true)))
                            @slot('active', sameRoutePrefix(data_get($item, 'route')))
                        @endcomponent
                    @endif
                @endforeach
            @endforeach

        @endcomponent
    </div>
</nav>

@push('scripts')
    <script>
        $(function() {
			$(".sidebar-search-input").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$(".sidebar-nav>li").filter(function() {
					text = value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
					$(this).toggle(
						$(this).text().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(text) > -1
					);
				});
			});

			document.onkeyup = function(e) {
				// Ctrl + b
				if (e.ctrlKey && e.which == 66) {
					$(".sidebar-search-input").focus();
				}
            };
            
            $('.without-submenu').on('click', function(event){
                $('.sidebar').removeClass('toggled'); 
            });
        });
    </script>
@endpush
