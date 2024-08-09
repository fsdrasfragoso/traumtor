<div class="form-group">
    {{ html()->label(__($title), $id ?? $name) }}
    <div class="input-group">
        {{ html()->text($id ?? $name, request()->input($name))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fal fa-calendar"></i></span>
        </div>
    </div>
</div>
