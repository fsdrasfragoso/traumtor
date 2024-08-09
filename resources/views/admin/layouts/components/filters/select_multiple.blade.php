@php($id = $id ?? $attribute)
@php($name = $name ?? "q[$attribute]")
@php($request_name = $request_name ?? "q.$attribute")
@php($label = $label ?? modelAttribute($type, $attribute))
@php($class = $class ?? 'form-control')
@php($options = $options ?? [])
<div class="form-group">
    {{ html()->label($label, $id) }}
    {{ html()->multiselect($name, $options, request()->input($request_name))
        ->id($id)
        ->class($class) }}
    @push('scripts')
        <script>
			$(function() {
				$('#{{ $id }}').select2();
			});
        </script>
    @endpush
</div>
