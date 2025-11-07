@if ($paginator->hasPages())
    <ul>
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="javascript:void(0)"><span><i class="fas fa-angle-double-left"></i></span></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination-link"><span><i class="fas fa-angle-double-left"></i></span></a></li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
            <li class="disabled"><a href="javascript:void(0)"><span>{{ $element }}</span></a></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><a href="javascript:void(0)"><span>{{ $page }}</span></a></li>
                @else
                    <li><a href="{{ $url }}" class="pagination-link"><span>{{ $page }}</span></a></li>
                @endif
            @endforeach
        @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination-link"><span><i class="fas fa-angle-double-right"></i></span></a></li>
        @else
            <li class="disabled"><a href="javascript:void(0)"><span><i class="fas fa-angle-double-right"></i></span></a></li>
        @endif
    </ul>
@endif