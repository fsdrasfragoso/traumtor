<div class="form-group">
    {{ html()->label(__('CPF'), 'q[profiles--document][contains]') }}
    {{ html()->text('q[profiles--document][contains]', request()->input('q.profiles--document.contains'))->class('form-control mask-cpf')->data('mask', '###.###.###-##') }}
</div>
