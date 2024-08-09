
<div class="card{{ isset($class) ? ' ' . $class : '' }}">
    <div class="card-header{{ isset($headerClass) ? ' ' . $headerClass : '' }}">
        <div class="d-flex justify-content-between">
            <div>

                <h5 class="card-title {{ !isset($subtitle) ? 'mb-0' : '' }}">{{ $title }}</h5>
            @if(isset($subtitle))
                <h6 class="card-subtitle">{!! $subtitle !!}</h6>
            @endif
            </div>
        </div>
        @if(isset($actions) && $actions)
            <div class="flex-shrink-1 text-right">
                {{ $actions }}
            </div>
        @endif

    </div>

    <div class="card-body{{ isset($bodyClass) ? ' ' . $bodyClass : '' }}">
        {{ $slot }}
    </div>
</div>
