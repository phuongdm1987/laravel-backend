@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" title="@lang('pagination.previous')" disabled>@lang('pagination.previous')</a>
        @else
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
        @else
            <a class="pagination-next" title="@lang('pagination.next')" disabled>@lang('pagination.next')</a>
        @endif

        <ul class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a></li>
                        @else
                            <li><a class="pagination-link" href="{{ $url }}" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
