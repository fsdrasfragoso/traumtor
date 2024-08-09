@php($routeName = request()->route()->getName())
<ul class="menu">
    <li class="menu__item {{ $routeName == 'web.frontend.profiles.edit' ? 'is-active' : '' }}">
        <a href="{{ route('web.frontend.profiles.edit') }}" class="menu__item__link" data-pjax="#main-content" data-pjax-noscroll>Meu Perfil</a>
    </li>
    <li class="menu__item {{ $routeName == 'web.frontend.preferences.edit' ? 'is-active' : '' }}">
        <a href="{{ route('web.frontend.preferences.edit') }}" class="menu__item__link" data-pjax="#main-content" data-pjax-noscroll>Meus Conteúdos</a>
    </li>
    <li class="menu__item {{ $routeName == 'web.frontend.preferences.edit' ? 'is-active' : '' }}">
        <a href="{{ route('web.frontend.preferences.edit') }}" class="menu__item__link" data-pjax="#main-content" data-pjax-noscroll>Avisos</a>
    </li>
</ul>
