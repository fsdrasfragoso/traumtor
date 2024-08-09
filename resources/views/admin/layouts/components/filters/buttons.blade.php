<div class="form-group">
    {{ html()->submit('Filtrar')->class('btn btn-primary') }}
    <a href="{{ $instance->route('index') }}" data-pjax class="btn btn-link">Limpar filtros</a>
</div>