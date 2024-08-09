<div title="Data de criação">
    {{ $instance->created_at->format(config('admin.date_format')) }}
</div>

@if($instance->canceled_at)
    <div>
        <span class="text-danger" title="Data de cancelamento">
            {{ $instance->canceled_at->format(config('admin.date_format')) }}
        </span>
    </div>
@endif
