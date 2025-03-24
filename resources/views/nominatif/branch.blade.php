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
            <h1 class="font-semibold text-lg leading-[27px]">Daftar Nominatif</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">{{ number_format($totalRow) }} Debitur</p>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-[30px]">
        <div class="px-2 sm:px-2 lg:px-4">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name,
                        title, email and role.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button type="button"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                        user</button>
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
