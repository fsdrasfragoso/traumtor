<nav class="navbar navbar-expand navbar-light bg-white">
    <a href="#" class="sidebar-toggle d-flex mr-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <span class="navbar-text ml-auto d-none d-xl-inline-block">
        </span>
        <ul class="navbar-nav ml-auto ml-xl-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown"
                   aria-expanded="false">
                    <span class="d-none d-sm-inline-block">
                      <img src="https://www.gravatar.com/avatar/{{ md5(user()->email) }}?d=mp"
                           class="avatar img-fluid rounded-circle mr-1" alt="{{ user()->name }}"> <span
                            class="text-dark">{{ user()->name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('web.admin.auth.user.edit') }}">
                        <i class="align-middle mr-1 fal fa-user"></i>
                        {{ __('Perfil') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('web.admin.logout') }}">{{ __('Sair') }}</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
