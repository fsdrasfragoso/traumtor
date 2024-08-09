<div class="form-group">
    {{ html()->label(__('Publicação final'), 'q[published_at][lesser]') }}
    <div class="input-group">
        {{ html()->text('q[published_at][lesser]', request()->input('q.published_at.lesser'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
