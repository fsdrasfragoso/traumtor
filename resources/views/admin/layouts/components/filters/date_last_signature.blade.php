<div class="form-group">
    {{ html()->label(__('Data da Ultima Assinatura'), 'q[date_last_signature]') }}
    <div class="input-group">
        {{ html()->text('q[date_last_signature]', request()->input('q.date_last_signature'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
