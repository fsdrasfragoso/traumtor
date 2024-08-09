<div class="d-flex {{ isset($class) ? $class : ''}} mb-2">
    <div class="header flex-grow-1">
        <h1 class="h3">{{ $title }}</h1>
        @if(isset($subtitle))
            <h2 class="h4">{{ $subtitle }}</h2>
        @endif
        {{ $slot }}
    </div>
    @if (isset($aside))
        <div class="aside">
            {{ $aside }}
        </div>
    @endif
</div>

@if(isset($breadcrumbs))
    <div style="margin-bottom: 2rem;">
        {!! $breadcrumbs->render() !!}
    </div>
@endif

