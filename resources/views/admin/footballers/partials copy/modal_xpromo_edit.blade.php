<div class="modal fade" id="xpromo-edit" tabindex="-1" role="dialog" aria-labelledby="xpromo-edit-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ html()->form('PUT', $instance->route('xpromo'))->open() }}
            <div class="modal-header">
                <h5 class="modal-title" id="xpromo-edit-label">Editar XPROMO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="xpromo">Novo XPROMO</label>
                    <input type="text" name="xpromo" class="form-control" id="xpromo" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
