@php($routeName = request()->route()->getName())
<div class="aside {{ isset($isNotAside) ? '' : 'aside--right' }}">
    <div class="pt-5">
        {{--
        @include('frontend.layouts.partials.quotes', [
            'id' => 'quotes' . (isset($isNotAside) ? '-sidebar' : '-aside')
        ])
        --}}
        @include('frontend.layouts.partials.top-contents', [
            'id' => 'top-contents' . (isset($isNotAside) ? '-sidebar' : '-aside')
        ])
    </div>
</div>


