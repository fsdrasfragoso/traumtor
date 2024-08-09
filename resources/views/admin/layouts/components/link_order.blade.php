@php

    $enableSortDirection = ($column == request()->input('order.by'));
    $direction = request()->input('order.dir');
    $toggledSortDirection = ($direction == 'asc') ? 'desc' : 'asc';
    $order = [
        'by' => $column,
        'dir' => 'asc',
    ];
    if ($enableSortDirection) {
        $order['dir'] = $toggledSortDirection;
    }
    $sortUrl = url()->getRequest()->fullUrlWithQuery([
        'order' => $order
    ]);
@endphp

<a href="{{ $sortUrl }}">
    @if($direction && $enableSortDirection)
        {{ $slot }} <i class="fal {{ $direction == 'asc' ? 'fa-long-arrow-down' : 'fa-long-arrow-up' }}"></i>
    @else
        {{ $slot }}
    @endif
</a>
