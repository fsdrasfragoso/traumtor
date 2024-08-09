@if(isset($prepend))
    <div class="form-group">
        {{ html()->label(__($title), $id) }}
        @component('admin.layouts.components.form.input_text_prepend')
            @slot('prepend', $prepend)
            {{ html()->text($id , request()->input($name))->class('form-control '.($class ?? '')) }}
        @endcomponent
    </div>
@else
    <div class="form-group">
        {{ html()->label(__($title), $id) }}
        {{ html()->text($id , request()->input($name))->class('form-control '.($class ?? '')) }}
    </div>
@endif
