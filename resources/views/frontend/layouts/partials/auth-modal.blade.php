<div id="auth-modal-container" class="d-none auth-modal-container">
    <div class="auth-modal">
        <button id='close-modal' type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>        
        </button>

        <h3>Você ainda não está logado!</h3>
        <p>
            Para ter acesso a essa função é preciso estar logado em sua conta traumtor. Caso já tenha, clique no botão a baixo ou crie sua conta facilmente.
        </p>
        <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
            <button class="auth-btn" type="button">
                <a href="{{ route('web.frontend.login') }}" data-pjax="#wrapper" data-redirect-back>Já sou assinante</a>
            </button>
        </div>
    </div>
</div>
