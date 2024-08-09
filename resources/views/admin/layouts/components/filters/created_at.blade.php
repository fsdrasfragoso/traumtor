<div class="form-group">
    {{ html()->label(__('Data da Importação'), 'q[created_at]') }}
    <div class="input-group">
        {{ html()->text('q[created_at]', request()->input('q.created_at'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
