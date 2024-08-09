@if(user())
    <div class="row header__container__admin-loggedin">
        <a href="{{ route('web.admin.default.show') }}" target="_blank" class="btn text-dark rounded-0 mx-0 d-inline h-100">
            <span class="fa fa-columns"></span>
            <span class="d-none d-sm-inline">Painel</span>
        </a>

        <a href="{{ $edit_link }}" target="blank" class="link-admin-loggedin btn text-dark rounded-0 mx-0 h-100 d-inline h-100 {{ empty($edit_link) ? 'd-none' : '' }}">
            <span class="fa fa-pencil"></span>
            <span class="title-admin-loggedin d-none d-sm-inline">{{ $edit_title }}</span>
        </a>

        <span class="d-flex align-items-center pl-1 font-family-secondary">
            Você está logado no admin.
        </span>
    </div>
    @push('scripts')
        <script>
            $(function() {
                initAdminLoggedBar('{{ $edit_title }}', '{{ $edit_link }}');
            });
        </script>
    @endpush
@endif