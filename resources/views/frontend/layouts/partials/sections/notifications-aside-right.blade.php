<div class="card-header title d-flex align-items-center bg-white">
    Selecionar
</div>
<div class="card-body">
    <div class="form-group">
        <div class="custom-control custom-switch">
            {{ html()->checkbox('select-read', request('select-read'))->class(['custom-control-input']) }}
            {{ html()->label('Lidas', 'select-read')->class('custom-control-label') }}
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            {{ html()->checkbox('select-all', request('select-all'))->class(['custom-control-input']) }}
            {{ html()->label('Todas', 'select-all')->class('custom-control-label') }}
        </div>
    </div>

    <a class="btn btn-primary py-2 w-100 delete-all-notification-button disabled" href="{{ route('web.frontend.notifications.delete') }}"
    data-method-pjax="#main"
    data-method="DELETE" data-confirm="Tem certeza que deseja excluir estas notificações?" class="btn btn-lg btn-trash mt-2 w-100 font-weight-bold d-none delete-all-notification-button" role="button" aria-pressed="true">
    <i class="fal fa-trash"></i>
    Excluir
    </a>
</div>
