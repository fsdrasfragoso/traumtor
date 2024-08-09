@if ($paginator->lastPage() > 1)
    <ul class="pagination" role="navigation">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link text-dark" href="{{ $paginator->url(1) }}" data-pjax="#main" rel="prev" aria-label="« Anterior">‹</a>
        </li>

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link {{ ($paginator->currentPage() == $i) ? ' text-light' : 'text-dark' }}" href="{{ $paginator->url($i) }}" data-pjax="#main">{{ $i }}</a>
            </li>
        @endfor

        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link text-dark" href="{{ $paginator->url($paginator->currentPage()+1) }}" data-pjax="#main" rel="next" aria-label="Próximo »">›</a>
        </li>
    </ul>
@endif
