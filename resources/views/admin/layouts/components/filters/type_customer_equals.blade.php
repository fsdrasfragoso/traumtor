@php($c_types = $types->toArray())
@php(asort($c_types))

<div class="form-group">
    {{ html()->label(__('Tipo de assinante'), 'q[type_footballer]') }}
    {{ html()->select('q[type_footballer]', $c_types, request()->input('q.type_footballer'))->placeholder('')->class('form-control') }}
</div>
