<div class="form-group form-row">
    <div class="col">
        {{ html()->label(__('Cartão (inicio)'), 'q[serial][0]') }}

        {{
            html()->text('q[serial][0]', request()->input('q.serial.0'))
                ->class('form-control mask-integer')
                ->attribute('maxlength', 6)
        }}
        <small class="form-text text-muted">
            Seis primeiros digitos
        </small>
    </div>
    <div class="col">
        {{ html()->label(__('(fim)'), 'q[serial][1]') }}

        {{
            html()->text('q[serial][1]', request()->input('q.serial.1'))
                ->class('form-control mask-integer')
                ->attribute('maxlength', 4)
        }}
        <small class="form-text text-muted">
            Quatro últimos digitos
        </small>
    </div>
</div>
