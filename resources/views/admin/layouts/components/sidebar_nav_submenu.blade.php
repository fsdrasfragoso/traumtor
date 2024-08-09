@if ((! isset($policy)) || $policy)
<li class="sidebar-item{{ isset($active) && $active ? ' active' : '' }}">
    <a href="#{{ $id }}" data-toggle="collapse" class="sidebar-link collapsed d-flex align-items-center">
        @if(isset($icon) && $icon)
            <span class="icon flex-shrink-0"><i class="{{ $icon }}"></i></span>
        @endif

        <span class="flex-grow-1">{{ $label }}</span>
    </a>
    <ul id="{{ $id }}" class="sidebar-dropdown list-unstyled collapse{{ isset($active) && $active ? ' show' : '' }}">
        {{ $slot }}
    </ul>
</li>
@endif
