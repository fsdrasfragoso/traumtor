<div class="form-group">
    {{ html()->label(__($title), $id) }}
    {{ html()->select($id, $options, request()->input($name))->placeholder('')->class('form-control') }}
</div>
