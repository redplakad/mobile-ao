@extends('layouts.second')

@section('content')
    <div class="relative w-full flex flex-col">
        {{-- Tombol Back --}}
        <div class="absolute top-8 left-4 z-10">
            <a href="{{ route('penagihan.index') }}" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mr-1" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l4 4"></path>
                    <path d="M5 12l4 -4"></path>
                </svg>
                Kembali
            </a>
        </div>
        <p
            class="absolute top-8 right-4 rounded-md px-2 py-1 text-white text-xs font-semibold shadow-sm
            {{ $data->hasil_kunjungan == 'Tidak Bayar' ? 'bg-gray-400' : 'bg-green-500' }}">
            {{ ucfirst($data->hasil_kunjungan) }}
        </p>
        {{-- Gambar Penagihan --}}
        @php
            $imageSources = [];

            if (!empty($data->image)) {
                $imageSources[] = [
                    'src' => $data->image,
                    'label' => 'Foto Debitur',
                ];
            }
            if (!empty($data->image1)) {
                $imageSources[] = [
                    'src' => $data->image1,
                    'label' => 'Foto Lokasi Penagihan',
                ];
            }
            if (!empty($data->image2)) {
                $imageSources[] = [
                    'src' => $data->image2,
                    'label' => 'Foto Debitur & Petugas',
                ];
            }
            if (!empty($data->image3)) {
                $imageSources[] = [
                    'src' => $data->image3,
                    'label' => 'Foto Lainnya',
                ];
            }
        @endphp

        {{-- Gambar Utama --}}
        <div class="relative w-full mb-4">
            <img id="mainImage" src="{{ $imageSources[0]['src'] ?? asset('assets/images/icons/placeholder.webp') }}"
                alt="Foto Utama" class="w-full h-auto object-cover shadow-md">
            <span id="mainImageLabel" class="absolute bottom-2 left-2 bg-black/70 text-gray-500 text-xs px-3 py-1 rounded">
                {{ $imageSources[0]['label'] ?? 'Gambar Utama' }}
            </span>
        </div>

        {{-- Thumbnail --}}
        <div class="flex gap-2 px-4">
            @foreach ($imageSources as $index => $item)
                <img src="{{ $item['src'] }}" alt="{{ $item['label'] }}"
                    class="thumbnail cursor-pointer w-20 h-20 object-cover rounded-md border border-gray-300 transition-all duration-200
                            {{ $index === 0 ? 'active-thumb ring-2 ring-blue-500' : '' }}"
                    data-src="{{ $item['src'] }}" data-label="{{ $item['label'] }}">
            @endforeach
        </div>

        {{-- Detail User --}}
        <div class="mt-2 px-4 flex items-center justify-between">
            <p class="text-xs text-gray-500">
                Ditagih Oleh {{ $data->user->name ?? 'User tidak ditemukan' }} • Pada
                {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}
            </p>

            @if (auth()->id() === $data->by_user)
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <!-- Trigger Button -->
                <div>
                    <button @click="open = !open"
                        type="button"
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        id="menu-button"
                        aria-expanded="true"
                        aria-haspopup="true">
                        Opsi
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
        
                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="menu-button"
                    tabindex="-1">
        
                    <div class="py-1" role="none">
                        <!-- Edit -->
                        <a href="{{ route('penagihan.edit', $data->uuid) }}"
                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem" tabindex="-1">
                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                            </svg>
                            Edit
                        </a>
        
                        <!-- Delete -->
                        <button type="button"
                            onclick="openDeleteModal('{{ $data->uuid }}')"
                            class="group flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100"
                            role="menuitem" tabindex="-1">
                            <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-600" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
        
        </div>


        {{-- Nama Debitur --}}
        <div class="mt-3 px-4">
            <h1 class="text-xl font-bold text-gray-800">{{ $data->nama_debitur }}</h1>
        </div>

        {{-- Informasi Penagihan --}}
        <div class="mt-4 space-y-4 px-4 pb-6">
            {{-- Nomor Kredit --}}
            <div class="bg-white p-4 rounded-md shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>
                    Nomor Kredit
                </p>
                <p class="text-base font-semibold text-gray-800">{{ $data->nomor_kredit }}</p>
            </div>

            {{-- Nomor Telepon --}}
            <div class="bg-white p-4 rounded-md shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                    Nomor Telepon
                </p>
                <p class="text-base font-semibold text-gray-800">{{ $data->no_telepon }}</p>
            </div>

            {{-- Uraian Kunjungan --}}
            <div class="bg-white p-4 rounded-md shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    Hasil Kunjungan
                </p>
                <p class="text-base text-gray-700 leading-relaxed">{{ $data->uraian_kunjungan }}</p>
            </div>

            <div class="bg-white p-4 rounded-md shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6l4 2m6-4.5A9 9 0 1 1 3 12a9 9 0 0 1 18 0Z" />
                    </svg>
                    Janji Bayar
                </p>
                <p class="text-base font-semibold text-gray-800">
                    {{ $data->janji_bayar ? \Carbon\Carbon::parse($data->janji_bayar)->format('d M Y') : '-' }}
                </p>

                @if ($data->janji_bayar)
                    @php
                        $now = \Carbon\Carbon::now();
                        $janjiBayar = \Carbon\Carbon::parse($data->janji_bayar);
                        $diffInHours = $now->diffInHours($janjiBayar, false);
                        $diffInDaysFloat = $now->diffInRealDays($janjiBayar, false);
                    @endphp
                    <p class="text-sm mt-1 text-gray-600">
                        @if ($diffInDaysFloat > 1)
                            {{ floor($diffInDaysFloat) }} hari lagi
                        @elseif ($diffInDaysFloat > 0)
                            {{ number_format($diffInHours) }} jam lagi
                        @elseif ($diffInDaysFloat === 0)
                            Hari ini adalah tanggal janji bayar
                        @else
                            @php
                                $lateHours = abs($diffInHours);
                                $lateDays = abs(floor($diffInDaysFloat));
                            @endphp
                            @if ($lateDays >= 1)
                                Terlewat {{ $lateDays }} hari yang lalu
                            @else
                                Terlewat {{ number_format($lateHours) }} jam yang lalu
                            @endif
                        @endif
                    </p>
                @endif
            </div>


        </div>

        {{-- Peta Lokasi --}}
        @if ($data->lat && $data->lng)
            <div class="mt-1 space-y-4 px-4 pb-6">
                <div class="bg-white rounded-md shadow-sm border border-gray-100">
                    <iframe
                        src="https://maps.google.com/maps?q={{ $data->lat }},{{ $data->lng }}&z=15&output=embed"
                        width="100%" height="250" style="border:0;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-[250px]"></iframe>
                    <div class="p-4" <p class="mt-2 text-base text-gray-700 leading-relaxed">{{ $data->address }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Konfirmasi Delete -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

        <div class="relative bg-white rounded-lg shadow-xl z-50 max-w-lg w-full p-6">
            <div class="flex justify-end">
                <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-start space-x-4">
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75M12 15.75h.007v.008H12v-.008zM3 18.75a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25L13.95 3.38c-.87-1.5-3.03-1.5-3.9 0L3 18.75z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Hapus Data Penagihan</h3>
                    <p class="mt-1 text-sm text-justify text-gray-500">
                        Apakah kamu yakin ingin menghapus data penagihan ini?
                        <br>
                        <br>
                        Data yang telah dihapus tidak dapat dipulihkan atau dikembalikan lagi.
                    </p>
                </div>
            </div>

            <form id="deleteForm" method="POST" class="mt-6">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 text-sm font-semibold bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-500">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('showSuccessModal'))
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50 transition ease-out duration-300">
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition ease-out duration-300 sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Berhasil Diupdate</h3>
                <p class="text-sm text-gray-500 mt-2">Data penagihan berhasil diperbarui.</p>
            </div>
            <div class="mt-5 sm:mt-6">
                <button onclick="document.getElementById('successModal').remove();" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endif
@endsection

@push('javascript')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function openDeleteModal(uuid) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `{{ url('/penagihan') }}/${uuid}`;
            modal.classList.remove('hidden');
        }
    
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
    <script>
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('mainImage');
        const label = document.getElementById('mainImageLabel');

        thumbnails.forEach((thumb) => {
            thumb.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                const imageLabel = this.getAttribute('data-label');

                // Ganti gambar utama
                mainImage.src = src;
                label.innerText = imageLabel;

                // Reset semua thumbnail
                thumbnails.forEach(t => {
                    t.classList.remove('active-thumb', 'ring-2', 'ring-blue-500');
                });

                // Tambahkan ring ke yang aktif
                this.classList.add('active-thumb', 'ring-2', 'ring-blue-500');
            });
        });

        const btn = document.getElementById('actionDropdownBtn');
        const menu = document.getElementById('actionDropdownMenu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
    <script>
        localStorage.removeItem("image1");
        localStorage.removeItem("image2");
        localStorage.removeItem("image3");
        localStorage.removeItem("image4");
    </script>
@endpush
