<div class="form-group">
    {{ html()->label(__('Futebolista'), 'q[footballer]') }}
    {{ html()->text('q[footballer]', request()->input('q.footballer'))->placeholder('Nome, e-mail ou CPF')->class('form-control') }}
</div>
