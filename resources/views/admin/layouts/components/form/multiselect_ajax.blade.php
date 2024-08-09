<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $name), $name) }}
    {{ html()->multiselect($name . '[]', $options, isset($value) ? $value : null)
        ->id($name)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attributeIf($required ?? false, 'required') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}

    @push('scripts')
        <script>
            $(function() {
                var $field = $('#{{ $name }}');
				$field.select2({
					ajax: {
						url: '{{ $url }}',
						dataType: 'json',
						delay: 250,
						data: function (params) {
							return {
								q: params.term,
								page: params.page
							};
						},
						processResults: function (data, params) {
							params.page = params.page || 1;
							return {
								results: data.data,
								pagination: {
									more: data.hasMorePages
								}
							};
						},
						cache: true
					}
				});
                $field.on('select2:close', function () {
                    $field.trigger('blur');
                });
            });
        </script>
    @endpush
</div>
