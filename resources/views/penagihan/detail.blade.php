@extends('layouts.second')

@section('content')
    <div class="relative w-full flex flex-col">
        {{-- Tombol Back --}}
        <div class="absolute top-8 left-4 z-10">
            <a href="{{ route('penagihan.index') }}" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l4 4"></path>
                    <path d="M5 12l4 -4"></path>
                </svg>
                Kembali
            </a>         
        </div>
        <p class="absolute top-8 right-4 rounded-md px-2 py-1 text-white text-xs font-semibold shadow-sm
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
            <span id="mainImageLabel"
                class="absolute bottom-2 left-2 bg-black/70 text-gray-500 text-xs px-3 py-1 rounded">
                {{ $imageSources[0]['label'] ?? 'Gambar Utama' }}
            </span>
        </div>

        {{-- Thumbnail --}}
        <div class="flex gap-2">
            @foreach($imageSources as $index => $item)
                <img src="{{ $item['src'] }}" alt="{{ $item['label'] }}"
                     class="thumbnail cursor-pointer w-20 h-20 object-cover rounded-md border border-gray-300 transition-all duration-200
                            {{ $index === 0 ? 'active-thumb ring-2 ring-blue-500' : '' }}"
                     data-src="{{ $item['src'] }}"
                     data-label="{{ $item['label'] }}">
            @endforeach
        </div>
        
        {{-- Detail User --}}
        <div class="mt-2 px-4 flex items-center justify-between">
            <p class="text-xs text-gray-500">
                Ditagih Oleh {{ $data->user->name ?? 'User tidak ditemukan' }} • Pada {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}
            </p>
        
            @if (auth()->id() === $data->by_user)
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <!-- Trigger Button -->
                <button @click="open = !open" class="p-2 flex items-center gap-1 rounded-md hover:bg-gray-200 transition">
                    Aksi
                    <!-- Icon Chevron Up/Down -->
                    <template x-if="!open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </template>
                    <template x-if="open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </template>
                </button>
            
                <!-- Dropdown Menu -->
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                >
                    <a href="{{ route('penagihan.edit', $data->uuid) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <!-- Edit Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('penagihan.destroy', $data->uuid) }}" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                            <!-- Delete Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Delete
                        </button>
                    </form>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
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
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-[250px]"></iframe>
                <div class="p-4"
                    <p class="mt-2 text-base text-gray-700 leading-relaxed">{{ $data->address }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@push('javascript')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    const label = document.getElementById('mainImageLabel');

    thumbnails.forEach((thumb) => {
        thumb.addEventListener('click', function () {
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

    document.addEventListener('click', function (e) {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
@endpush