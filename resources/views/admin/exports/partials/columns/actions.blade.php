@if($instance->status == App\Models\Export::STATUS_SUCCESS)
    @if($media = $instance->getFirstMedia('csv'))
        <a href="{{ route('web.admin.exports.download', $instance) }}" class="btn btn-info btn-sm" target="_blank" data-toggle="tooltip" title="Download" download>
            <i class="fal fa-cloud-download"></i>
        </a>
    @endif
@endif
