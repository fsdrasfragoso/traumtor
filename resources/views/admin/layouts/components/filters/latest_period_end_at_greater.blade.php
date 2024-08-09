<div class="form-group">
    {{ html()->label(__('Fim do ciclo inicial'), 'q[latest_period_end_at_greater]') }}
    <div class="input-group">
        {{ html()->text('q[latest_period_end_at_greater]', request()->input('q.latest_period_end_at_greater'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
