@if ($paginator->hasPages())
    <ul class="pagination">
        @if(!$paginator->onFirstPage())
            <li class="pagination__li">
                <a href="{{ request()->fullUrlWithQuery(['page' => $paginator->currentPage()-1]) }}" class="pagination__link {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">
                    <i class="icon icon-arrow-left"></i>
                </a>
            </li>
        @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @php
                $limit = 9;
                $half_total_links = floor($limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                    $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
            @endphp
            @if ($from < $i && $i < $to)
                <li class="pagination__li">
                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                       class="pagination__link {{ ($paginator->currentPage() == $i) ? ' active disabled' : '' }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        @if($paginator->hasMorePages())
            <li class="pagination__li">
                <a href="{{ request()->fullUrlWithQuery(['page' => $paginator->currentPage()+1]) }}" class="pagination__link {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
                    <i class="icon icon-arrow-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
