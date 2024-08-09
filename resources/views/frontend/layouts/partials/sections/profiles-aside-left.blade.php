@php($routeName = request()->route()->getName())
<div class="position-relative menu-list">

    <div class="position-absolute w-100 mt-2" style="z-index: 1">
        <a href="#" class="w-100" data-pjax="#main"> {{-- Falta inserir o link --}}
            <div class="rounded-sm p-2 badge-back">
                <i class="fas fa-arrow-left mr-2"></i> Área do assinante
            </div>
            {{-- @php($avatar = $footballer ? $footballer->getFirstMedia('avatar') : null)
            @php($avatar_url = $avatar ? $avatar->getUrl() : 'https://www.gravatar.com/avatar/' . md5($footballer ? $footballer->email : '') . '?d=mp')
            <img src="{{ $avatar_url }}" class="rounded-circle" alt=""> --}}
        </a>
    </div>

    <div class="bg-dark rounded-sm position-relative pt-5 pb-1 ml-2">
        
        <ul class="px-3 mt-3" style="list-style-type: none">
            <li class="page-active {{ $routeName == 'web.frontend.profiles.edit' ? 'is-active' : '' }} py-1">
                <a href="{{ route('web.frontend.profiles.edit') }}" data-pjax="#main" class="text-light">
                    <span>
                        Meu Perfil
                    </span>
                </a>
            </li>
            <li class="page-active {{ $routeName == 'web.frontend.preferences.edit' ? 'is-active' : '' }} py-1">
                <a href="{{ route('web.frontend.preferences.edit') }}" data-pjax="#main" class="text-light">
                    <span>
                        Meus Conteúdos
                    </span>
                </a>
            </li>
            <li class="page-active {{ $routeName == 'web.frontend.preferences.edit' ? 'is-active' : '' }} py-1">
                <a href="{{ route('web.frontend.preferences.edit') }}" data-pjax="#main" class="text-light">
                    <span>
                        Avisos
                    </span>
                </a>
            </li>
        </ul>
            
    </div>
</div>

<style>
    .badge-back {
        background-color: #DFDE1A;
        color: #222222;
    }
</style>
