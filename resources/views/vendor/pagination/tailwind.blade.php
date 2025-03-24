@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        {{-- Mobile View --}}
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            @else
                <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 cursor-not-allowed">Next</span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
                            <span class="sr-only">Previous</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset">...</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @else
                        <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
                            <span class="sr-only">Next</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </nav>
@endif
