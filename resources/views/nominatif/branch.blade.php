@extends('layouts.second')

@section('title', 'Daftar Penagihan')
@section('content')
    <div id="Top-nav" class="relative flex items-center justify-between px-4 pt-10">
        <!-- Back Button -->
        <a href="{{ route('front.index') }}">
            <div class="w-10 h-10 flex shrink-0 items-center">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>

        <!-- Title Centered -->
        <div class="absolute left-1/2 top-10 transform -translate-x-1/2 text-center">
            <h1 class="font-semibold text-lg leading-[27px]">NOMINATIF</h1>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-[30px]">
        <div class="px-2 sm:px-2 lg:px-4">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $user->branch?->branch_name }}</h1>
                    <p class="mt-2 text-sm text-gray-700"></p>
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Pencarian Debitur</label>
                <div class="mt-2 flex rounded-md shadow-sm">
                  <div class="relative flex flex-grow items-stretch focus-within:z-10">
                    <input type="email" name="email" id="email" class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-xs sm:leading-6" placeholder="John Smith">
                  </div>
                  <button type="submit" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                      </svg>
                      
                    cari
                  </button>
                </div>
              </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900">Nama</th>
                            <th scope="col" class="hidden px-2 py-2 text-left text-xs font-semibold text-gray-900 lg:table-cell">Bakidebet</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900 sm:table-cell">Durasi</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900 sm:table-cell">Tungg.</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900">Kol</th>
                            <th scope="col" class="px-2 py-2 text-right text-xs font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($nominatifs as $nominatif)
                            <tr>
                                <td class="w-full max-w-0 py-2 pl-2 pr-2 text-xs font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                                    {{ $nominatif->NAMA_NASABAH }}
                                    <dl class="font-normal lg:hidden">
                                        <dt class="sr-only">No Rekening</dt>
                                        <dd class="mt-1 truncate text-gray-500">{{ $nominatif->NOREK }}</dd>
                                        <dt class="sr-only sm:hidden">Bakidebet</dt>
                                        <dd class="mt-1 truncate text-gray-500 sm:hidden">
                                            Rp. {{ number_format($nominatif->POKOK_PINJAMAN,2) }}
                                        </dd>
                                        <dt class="sr-only sm:hidden">Produk</dt>
                                        <dd class="mt-1 truncate text-gray-500 sm:hidden">
                                            {{ $nominatif->KET_KD_PRD }}
                                        </dd>
                                    </dl>
                                </td>
                                <td class="hidden px-2 py-2 text-xs text-gray-500 lg:table-cell">
                                    {{ number_format($nominatif->POKOK_PINJAMAN, 2) }}
                                </td>
                                <td class="px-2 py-2 text-xs text-gray-500 sm:table-cell">
                                    {{ number_format($nominatif->JML_HARI_TUNGGAKAN, 0) }}
                                </td>
                                <td class="px-2 py-2 text-xs text-gray-500 sm:table-cell">
                                    {{ number_format(($nominatif->TUNGGAKAN_POKOK + $nominatif->TUNGGAKAN_BUNGA), 2) }}
                                </td>
                                <td class="px-2 py-2 text-xs text-gray-500">1</td>
                                <td class="py-2 pl-2 pr-4 text-right text-xs font-medium sm:pr-0">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        Detail<span class="sr-only">, {{ $nominatif->NAMA_NASABAH }}</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-sm text-gray-500">
                                    Data nominatif tidak tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if ($nominatifs->hasPages())
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">
                        <a href="{{ $nominatifs->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 {{ $nominatifs->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Previous
                        </a>
                        <a href="{{ $nominatifs->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 {{ $nominatifs->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $nominatifs->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $nominatifs->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $nominatifs->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            {{ $nominatifs->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            @endif            
        </div>

    </div>

@endsection
@push('javascript')
    <script>
        localStorage.removeItem("image1");
        localStorage.removeItem("image2");
        localStorage.removeItem("image3");
        localStorage.removeItem("image4");
    </script>
@endpush
