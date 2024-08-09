@php($preview = $preview ?? false)
@php($num_lines_title = 15)
<div class="flex-column aside-subfolders">
    <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
        <a class="back-to-default d-flex align-items-center" href="{{ route('web.frontend.folders.show', [$folder->slug]) }}" data-pjax="#main">
            <i class="fas fa-arrow-left mr-2 font-weight-bold"></i>
            <span>
                {{ $folder->title }}
            </span>
        </a>
    </span>

    @include('frontend.layouts.partials.subfolders-nav')
</div>
