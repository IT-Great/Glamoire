@if ($paginator->hasPages())
    <div class="pt-md-2 pt-0">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-3">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#" aria-hidden="true">&laquo;</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#" aria-hidden="true">&raquo;</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
