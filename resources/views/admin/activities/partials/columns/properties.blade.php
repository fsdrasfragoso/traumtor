<a href="#data-{{ $instance->id }}" data-toggle="collapse">Detalhes</a>
<pre id="data-{{ $instance->id }}" class="collapse"><code class="json"> {{ json_encode($instance->properties, JSON_PRETTY_PRINT) }}</code></pre>
