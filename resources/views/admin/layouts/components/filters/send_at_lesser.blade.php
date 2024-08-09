<div class="form-groupl">
    {{ html()->label(__('Envio final'), 'q[send_at][greater]') }}
    <div class="input-group">
        {{ html()->text('q[send_at][greater]', request()->input('q.send_at.greater'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
