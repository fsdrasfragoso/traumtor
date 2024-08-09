<div class="form-group">
    {{ html()->label(__('Chave/RPS'), 'q[key][equals]') }}
    {{ html()->text('q[key][equals]', request()->input('q.key.equals'))->class('form-control') }}
</div>
