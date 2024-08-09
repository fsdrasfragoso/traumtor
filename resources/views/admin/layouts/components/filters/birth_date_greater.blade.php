<div class="form-group">
    {{ html()->label(__('Data de Nascimento inicial'), 'q[birth_date][greater]') }}
    <div class="input-group">
        {{ html()->text('q[birth_date][greater]', request()->input('q.birth_date.greater'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
