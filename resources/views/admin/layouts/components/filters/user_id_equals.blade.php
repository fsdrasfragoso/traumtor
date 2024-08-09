<div class="form-group">
    {{ html()->label(__('Usuário'), 'q[user_id][equals]') }}
    {{ html()->select('q[user_id][equals]', $users, request()->input('q.user_id.equals'))->placeholder(null)->class('form-control') }}
</div>
