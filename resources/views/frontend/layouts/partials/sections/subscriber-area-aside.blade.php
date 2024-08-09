@php($routeName = request()->route()->getName())
<nav class="aside-nav d-flex flex-column">

    <ul class="d-flex flex-column">
        <li class="menu__item subscriber-item {{ $routeName == 'web.frontend.profiles.edit' ? 'is-subscriber-active' : '' }}">
            <a href="{{ route('web.frontend.profiles.edit') }}" class="menu__item__link d-flex justify-content-between" data-pjax="#main">
                <span>
                    Meus Dados
                </span>
            </a>
        </li>
        <li class="menu__item subscriber-item {{ $routeName == 'web.frontend.preferences.edit' ? 'is-subscriber-active' : '' }}">
            <a href="{{ route('web.frontend.preferences.edit') }}" class="menu__item__link d-flex justify-content-between" data-pjax="#main">
                <span>
                    Minhas compras
                </span>
            </a>
        </li>
    </ul>
</nav>
