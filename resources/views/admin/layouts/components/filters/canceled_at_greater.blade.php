<div class="form-group">
    {{ html()->label(__('Cancelamento inicial'), 'q[canceled_at][greater]') }}
    <div class="input-group">
        {{ html()->text('q[canceled_at][greater]', request()->input('q.canceled_at.greater'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
