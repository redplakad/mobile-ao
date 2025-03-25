@extends('layouts.second')

@section('title', 'Daftar Penagihan')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('nominatif.index') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">NOMINATIF</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">{{ $user->branch?->branch_name }}</p>
        </div>
        <a href="{{ route('front.index') }}" class="w-10 h-10 flex shrink-0 ml-4">
            <x-tabler-home />
        </a>
    </div>
    <div class="flex flex-col gap-6 mt-[30px]">
        <div class="px-2 sm:px-2 lg:px-4">
            <div x-data="{ open: false }">
                <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-50"
                    @click="open = false">
                </div>
                <form action="{{ route('nominatif.cabang', $user->branch?->branch_code) }}" method="GET">
                    <div class="mt-2 flex rounded-md shadow-sm">
                        <div class="relative flex flex-grow items-stretch focus-within:z-10">
                            <input type="text" name="q" id="q"
                                class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-xs sm:leading-6"
                                placeholder="Pencarian Debitur" value="{{ request('q') }}">
                        </div>
                        <button type="submit"
                            class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-xs font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Cari
                        </button>
                        <button type="button" x-on:click="open = true"
                            class="relative ml-2 inline-flex items-center gap-x-1.5 rounded-md px-3 py-2 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18M5 12h14m-7 7h7" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </form>

                <!-- Modal Filter -->
                <div x-show="open" x-cloak
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
                    x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div class="bg-white rounded-lg p-6 shadow-lg"
                        x-transition:enter="transition transform ease-out duration-300"
                        x-transition:enter-start="scale-90 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                        x-transition:leave="transition transform ease-in duration-200"
                        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-90 opacity-0">

                        <h2 class="text-lg font-semibold text-gray-900">Filter Data Kredit</h2>
                        <form method="GET" action="{{ route('nominatif.cabang', $user->branch?->branch_code) }}">
                            <input type="hidden" name="q" value="{{ request('q') }}">

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Kolektibilitas</label>
                                <select name="kolektibilitas" class="w-full border rounded p-2 mb-3">
                                    <option value="">Pilih Kolektibilitas</option>
                                    <option value="1" {{ request('kolektibilitas') == '1' ? 'selected' : '' }}>Lancar</option>
                                    <option value="2" {{ request('kolektibilitas') == '2' ? 'selected' : '' }}>Dalam Perhatian Khusus</option>
                                    <option value="3" {{ request('kolektibilitas') == '3' ? 'selected' : '' }}>Kurang Lancar</option>
                                    <option value="4" {{ request('kolektibilitas') == '4' ? 'selected' : '' }}>Diragukan</option>
                                    <option value="5" {{ request('kolektibilitas') == '5' ? 'selected' : '' }}>Macet</option>
                                </select>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Account Officer</label>
                                <select name="ao" class="w-full border rounded p-2 mb-3">
                                    <option value="">Pilih AO</option>
                                    @foreach ($listAO as $ao)
                                        <option value="{{ $ao }}" {{ request('ao') == $ao ? 'selected' : '' }}>{{ $ao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Produk</label>
                                <select name="produk" class="w-full border rounded p-2 mb-3">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($listProduk as $produk)
                                        <option value="{{ $produk }}" {{ request('produk') == $produk ? 'selected' : '' }}>{{ $produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Instansi</label>
                                <input 
                                    type="text" 
                                    name="instansi" 
                                    list="instansi-list" 
                                    x-data="{ search: '{{ request('instansi') }}' }"
                                    x-model="search"
                                    class="w-full border rounded p-2 mb-3" 
                                    placeholder="Cari Instansi..."
                                />
                                <datalist id="instansi-list">
                                    @foreach ($listInstansi as $instansi)
                                        <option value="{{ $instansi }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                                                    

                            <div class="mt-6 flex justify-end">
                                <button type="button" x-on:click="open = false"
                                    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md">Batal</button>
                                <button type="submit"
                                    class="ml-3 px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-500 rounded-md">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div x-data="{ showDetail: false, selectedData: null }" class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900">Nama</th>
                            <th scope="col"
                                class="hidden px-2 py-2 text-left text-xs font-semibold text-gray-900 lg:table-cell">
                                Bakidebet</th>
                            <th scope="col"
                                class="px-2 py-2 text-left text-xs font-semibold text-gray-900 sm:table-cell">Durasi</th>
                            <th scope="col"
                                class="px-2 py-2 text-left text-xs font-semibold text-gray-900 sm:table-cell">Tungg.</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-semibold text-gray-900">Kol</th>
                            <th scope="col" class="px-2 py-2 text-right text-xs font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kolekMapping = [
                                1 => "1-Lancar",
                                2 => "2-DPK",
                                3 => "3-Kurang Lancar",
                                4 => "4-Diragukan",
                                5 => "5-Macet",
                            ];
                        @endphp
                        @forelse ($kredit as $index => $nominatif)
                            <tr>
                                <td class="w-full max-w-0 py-2 pl-2 pr-2 text-xs font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                                    {{ $nominatif->NAMA_NASABAH }}
                                    <dl class="font-normal lg:hidden">
                                        <dt class="sr-only">No Rekening</dt>
                                        <dd class="mt-1 truncate text-gray-500">{{ $nominatif->NOREK }}</dd>
                                        <dt class="sr-only sm:hidden">Bakidebet</dt>
                                        <dd class="mt-1 truncate text-gray-500 sm:hidden">
                                            Rp. {{ number_format($nominatif->POKOK_PINJAMAN, 2) }}
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
                                    {{ number_format($nominatif->TUNGGAKAN_POKOK + $nominatif->TUNGGAKAN_BUNGA, 2) }}
                                </td>
                                <td class="px-2 py-2 text-xs text-gray-500">{{ $nominatif->KODE_KOLEK }}</td>
                                <td class="py-2 pl-2 pr-4 text-right text-xs font-medium sm:pr-0">
                                    <button 
                                    @click="selectedData = {
                                        NAMA_NASABAH: '{{ $nominatif->NAMA_NASABAH }}',
                                        NOREK: '{{ $nominatif->NOREK }}',
                                        POKOK_PINJAMAN: {{ $nominatif->POKOK_PINJAMAN }},
                                        JML_HARI_TUNGGAKAN: {{ $nominatif->JML_HARI_TUNGGAKAN }},
                                        TUNGGAKAN_POKOK: {{ $nominatif->TUNGGAKAN_POKOK }},
                                        TUNGGAKAN_BUNGA: {{ $nominatif->TUNGGAKAN_BUNGA }},
                                        KET_KD_PRD: '{{ $nominatif->KET_KD_PRD }}',
                                        KODE_KOLEK: '{{ $kolekMapping[$nominatif->KODE_KOLEK] ?? "Tidak Diketahui" }}',
                                        INSTANSI: '{{ $nominatif->TEMPAT_BEKERJA }}',
                                        ALAMAT: '{{ $nominatif->ALAMAT }}',
                                        AO: '{{ $nominatif->AO }}',
                                        TGL_PK: '{{ $nominatif->TGL_PK }}'
                                    }; showDetail = true" 
                                    class="text-indigo-600 hover:text-indigo-900"
                                >
                                    Detail
                                </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-sm text-gray-500">
                                    Data nominatif tidak tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            
                <!-- Modal Detail -->
                <template x-if="showDetail">
                    <div 
                        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 p-4 z-50"
                        @click="showDetail = false"
                    >
                        <div 
                            class="bg-white rounded-lg shadow-lg w-full max-w-md"
                            @click.stop
                        >
                        <div class="p-6 w-full max-w-lg">
                            <h2 class="text-xl font-semibold text-gray-900 border-b pb-3">Detail Nasabah</h2>
                            
                            <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-700">
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Nama</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.NAMA_NASABAH"></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">No Rekening</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.NOREK"></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Bakidebet</span>
                                    <span class="font-medium text-green-600">Rp. <span x-text="selectedData ? Number(selectedData.POKOK_PINJAMAN).toLocaleString() : ''"></span></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Hari Tunggakan</span>
                                    <span class="font-medium text-red-500" x-text="selectedData?.JML_HARI_TUNGGAKAN"></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Tunggakan Pokok</span>
                                    <span class="font-medium text-red-600">Rp. <span x-text="selectedData ? Number(selectedData.TUNGGAKAN_POKOK).toLocaleString() : ''"></span></span>
                                </div>                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Tunggakan Bunga</span>
                                    <span class="font-medium text-red-600">Rp. <span x-text="selectedData ? Number(selectedData.TUNGGAKAN_BUNGA).toLocaleString() : ''"></span></span>
                                </div>                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Total Tunggakan</span>
                                    <span class="font-medium text-red-600">Rp. <span x-text="selectedData ? Number(selectedData.TUNGGAKAN_POKOK + selectedData.TUNGGAKAN_BUNGA).toLocaleString() : ''"></span></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Produk</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.KET_KD_PRD"></span>
                                </div>
                        
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Kolektibilitas</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.KODE_KOLEK"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Alamat</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.ALAMAT"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-gray-500">TEMPAT BEKERJA</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.INSTANSI"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-gray-500">Account Officer</span>
                                    <span class="font-medium text-gray-900" x-text="selectedData?.AO"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a :href="`https://wa.me/6281234567890?text=Halo%20*${selectedData.NAMA_NASABAH}*,%0A%0AKami%20dari%20Bagian%20Penagihan%20ingin%20menginformasikan%20bahwa%20Anda%20memiliki%20tunggakan%20pembayaran.%0A%0A📅%20*Tanggal%20Jatuh%20Tempo*:%20${formatTanggalJatuhTempo(selectedData.TGL_PK)}%0A💰%20*Tunggakan%20Pokok*:%20Rp${formatRupiah(selectedData.TUNGGAKAN_POKOK)}%0A💸%20*Tunggakan%20Bunga*:%20Rp${formatRupiah(selectedData.TUNGGAKAN_BUNGA)}%0A⏳%20*Durasi%20Keterlambatan*:%20${selectedData.JML_HARI_TUNGGAKAN}%20hari%0A%0AMohon%20untuk%20segera%20melakukan%20pembayaran%20agar%20terhindar%20dari%20denda%20dan%20sanksi%20lebih%20lanjut.%20Silakan%20hubungi%20kami%20jika%20ada%20pertanyaan.%0A%0ATerima%20kasih.`"
                                    target="_blank" 
                                    class="inline-flex items-center gap-2 px-4 py-2 text-white bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                                        <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"></path><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"></path><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"></path><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"></path><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"></path>
                                        </svg>
                                    <span>Chat via WhatsApp</span>
                                </a>
                                                                
                            </div>
                        </div>
                        <div class="mx-4 my-4">                        
                            <div class="mt-6 flex justify-end">
                                <button @click="showDetail = false" 
                                    class="rounded-md bg-white px-2.5 py-1.5 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Tutup
                                </button>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </template>
            </div>
            

            <!-- Pagination -->
            @if ($kredit->hasPages())
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">
                        <a href="{{ $kredit->appends(request()->query())->previousPageUrl() }}"
                            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 
                              {{ $kredit->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Previous
                        </a>
                        <a href="{{ $kredit->appends(request()->query())->nextPageUrl() }}"
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 
                              {{ $kredit->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $kredit->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $kredit->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $kredit->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            {{ $kredit->appends(request()->query())->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

@endsection
@push('javascript')
    <!-- Alpine.js v3 -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function formatTanggalJatuhTempo(tglPK) {
            let tgl = new Date(tglPK);
            let now = new Date();
            return `${tgl.getDate()} ${new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(now)} ${now.getFullYear()}`;
        }
    
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka).replace(/,00$/, '');
        }
    </script>    
@endpush
