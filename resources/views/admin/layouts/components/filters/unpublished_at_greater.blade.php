<div class="form-groupl">
    {{ html()->label(__('Despublicação inicial'), 'q[unpublished_at][lesser]') }}
    <div class="input-group">
        {{ html()->text('q[unpublished_at][lesser]', request()->input('q.unpublished_at.lesser'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
