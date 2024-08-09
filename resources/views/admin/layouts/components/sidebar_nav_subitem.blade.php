@if ((! isset($policy)) || $policy)
    <li class="sidebar-item{{ isset($active) && $active ? ' active' : '' }} without-submenu">
        <a class="sidebar-link" href="{{ $url }}"  {{ $pjax ? 'data-pjax' : '' }}>{{ $label }}</a>
    </li>
@endif
