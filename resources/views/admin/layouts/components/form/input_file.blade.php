<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $name), $name) }}
    @if($media = $instance->getFirstMedia($name))
        <div class="mb-2">
            <a href="{{ $media->getUrl() }}" target="_blank">
                <i class="fal fa-file fa-lg"></i>
            </a>
        </div>
        <div class="mb-2">
            <code>
                {{ $media->getUrl() }}
            </code>
            <br />
            <small> {{ $media->human_readable_size }} | {{ $media->mime_type }} </small>
        </div>
        <div class="mb-3">
            <a href="{{ route('web.admin.medias.delete', $media) }}" data-method="DELETE" data-method-pjax="true" data-confirm="{{ trans('models.default.actions.confirmation.delete') }}" class="btn btn-danger btn-sm">Excluir arquivo</a>
        </div>
    @endif
    {{ html()->file($name)
        ->class(['d-block', 'is-invalid' => $errors->has($name)])
        ->addClass($class ?? '')
        ->attributeIf($required ?? false, 'required') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
