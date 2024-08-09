@php
    use Carbon\Carbon;
@endphp
@php($footballer = footballer())
@php($date = new Datetime($footballer->created_at))
@if($footballer)
<div class="profile-avatar">
    @if($footballer)
        <a href="{{ route('web.frontend.profiles.editAvatar') }}" class="avatar mb-2" data-pjax="#main">
            <div class="avatar__drop"><i class="fal fa-edit"></i></div>
            @php($avatar = $footballer ? $footballer->getFirstMedia('avatar') : null)
            @php($avatar_url = $avatar ? $avatar->getUrl() : 'https://www.gravatar.com/avatar/' . md5($footballer ? $footballer->email : '') . '?d=mp')
            <img src="{{ $avatar_url }}" class="rounded-circle" alt="">
        </a>
    @else
        <a href="{{ route('web.frontend.login') }}" class="avatar mr-2">
            @php($avatar_url = 'https://www.gravatar.com/avatar/' . md5('') . '?d=mp')
            <img src="{{ $avatar_url }}" class="rounded-circle" alt="">
        </a>
    @endif
    <div class="name">
        
        @if($footballer)
        <div class="text-center avtr-desc">
            Conta Criada em 
            {{Carbon::parse($footballer->created_at)->day}} de 
            {{Carbon::parse($footballer->created_at)->locale('pt_BR')->monthName}} de
            {{Carbon::parse($footballer->created_at)->year}}
        </div>
        @endif
    </div>
</div>
@else
    <div>
        <h2 class="h2 mb-2">Seja bem-vindo!</h2>
        <p>Faça o login com sua conta e aproveite seus conteúdos exclusivos.</p>
        <a href="{{ route('web.frontend.login') }}" class="btn btn-outline-primary btn-lg text-uppercase d-block mb-2" data-redirect-back>Entrar agora</a>
    </div>
@endif
