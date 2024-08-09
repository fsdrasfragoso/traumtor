@php
$resource = Str::snake(class_basename($instance->model), '_');
$resources = Str::plural($resource);

$route = 'web.admin.' . $resources . '.index';
@endphp

@if(Route::has($route))
<a href="{{ route($route, $instance->parameters) }}" target="_blank">
    {{ modelName($instance->model) }}
</a>
@else
    {{ modelName($instance->model) }}
@endif
