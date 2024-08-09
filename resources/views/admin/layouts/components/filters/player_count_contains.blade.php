<div class="form-group">
    {{ html()->label(__('Quantidade de jogadores por time '), 'q[player_count][contains]') }}
    {{ html()->number('q[player_count][contains]', request()->input('q.player_count.contains'))->class('form-control') }}
</div>
