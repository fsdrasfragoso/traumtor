<div class="form-group">
    {{ html()->label(__('Data da Primeira Assinatura'), 'q[date_first_signature]') }}
    <div class="input-group">
        {{ html()->text('q[date_first_signature]', request()->input('q.date_first_signature'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
