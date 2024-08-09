<nav id="sidebar-footballer" class="navbar navbar-expand-lg navbar-right navbar-light bg-dark">
    <a class="navbar-brand" href="{{ route('web.frontend.default.index') }}"><img src="{{ config('admin.icon') }}" alt="traumtor"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto my-auto">
            @if(url()->current() === route('web.frontend.books.index'))
                @if($footballer)
                    <li class="nav-item">
                        <a href="{{ route('web.frontend.profiles.edit') }}" class="btn bg-primary mt-2 mt-sm-0 mb-2 mb-sm-0" style="color: #fff;">Minha área</a>
                    </li>
                @endif
            @elseif($subscribe_url)
                <li class="nav-item">
                    <a href="{{ $subscribe_url }}" class="btn bg-primary mt-2 mt-sm-0 mb-2 mb-sm-0" style="color: #fff;">{{ $subscribe_text_button }}</a>
                </li>
            @endif
        </ul>

        @if(!$footballer)
            <a class="to-login text-white" href="{{ route('web.frontend.login') }}" data-redirect-back>
                <i class="fal fa-sign-in-alt fs-20"></i>
                <span>Entrar</spam>
            </a>
        @else
            <a class="logout text-white" href="{{ route('web.frontend.logout') }}">
                <i class="icon fal fa-sign-out"></i>
                <span>Sair</span>
            </a>
        @endif
    </div>
</nav>

