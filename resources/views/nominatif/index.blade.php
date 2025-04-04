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
            <p class="text-sm leading-[21px] text-[#909DBF]"></p>
        </div>
    </div>

    <div class="flex flex-col gap-6 px-4 mt-[30px]">
        <div x-data="{ open: false }">
            <!-- Tombol Pilih Tanggal -->
            <button @click="open = true"
                class="flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                </svg>

                Pilih Tanggal
            </button>

            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Pilih Tanggal Data</h2>

                    <!-- Tombol Close -->
                    <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-md">
                        &times;
                    </button>

                    <!-- Form -->
                    <form>
                        <!-- Select CAB -->
                        <label for="cab" class="block text-sm font-medium text-gray-700">Cabang</label>
                        <select id="cab" name="cab"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Pilih Cabang</option>
                            @foreach ($cabs as $cab)
                                <option value="{{ $cab }}" {{ $cab == $selectedCab ? 'selected' : '' }}>
                                    {{ $cab }}</option>
                            @endforeach
                        </select>

                        <div x-data="datePicker()" class="relative mt-4">
                            <label for="datadate" class="block text-sm font-medium text-gray-700">Tanggal Data</label>

                            <input type="date" id="datadate" name="datadate" x-model="selectedDate"
                                :max="maxDate" :min="minDate"
                                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 disabled:bg-gray-200 disabled:cursor-not-allowed"
                                required>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit"
                            class="w-full mt-4 bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if (!$dataExists)
            <div
                class="flex flex-col items-center justify-center text-center p-6 w-full h-[300px] bg-white border border-dashed border-gray-300 rounded-[20px] shadow-sm">
                <div class="w-24 h-24 mb-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-full h-full">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Data tidak ditemukan.</h2>
                <p class="text-sm text-gray-500 max-w-sm">Silahkan pilih tanggal yang lain atau gunakan tanggal
                    {{ \Carbon\Carbon::parse($latestDate)->format('Y-m-d') }}.</p>
            </div>
        @else
            
            <div class="bg-white rounded-xl p-4 shadow-sm flex flex-col space-y-2">
                <div class="flex items-center space-x-3">
                    <!-- Icon Box -->
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path>
                        </svg>
                    </div>

                    <div class="flex-1">
                    <a href="{{ route('nominatif.cabang', [
                            'branch_code' => $selectedCab, 
                            'datadate' => implode(',', (array) request()->query('datadate', $datadates))
                        ]) }}">
                        <h3 class="text-sm font-bold mt-1">Nominatif Kredit</h3>
                    </a>
                        <h3 class="text-sm font-bold mt-1">
                            <span class="font-normal text-gray-500">Daftar Nominatif kredit {{ $selectedCabName }}</span>
                        </h3>
                    </div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-600 mt-1">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z">
                            </path>
                        </svg>
                        <span class="text-xs">{{ \Carbon\Carbon::parse($selectedDatadate)->format('d M Y') }}</span>
                    </div>

                    @php
                        $participants = 20;
                        $avatars = ['https://i.pravatar.cc/40?img=1', 'https://i.pravatar.cc/40?img=2', 'https://i.pravatar.cc/40?img=3'];
                    @endphp

                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            @foreach ($avatars as $avatar)
                                <img src="{{ $avatar }}" alt="avatar"
                                    class="w-6 h-6 rounded-full border-2 border-white object-cover">
                            @endforeach
                        </div>
                        <div class="flex items-center gap-1 text-gray-500">
                            <x-tabler-eye class="w-5 h-5 text-gray-500 text-xs" />
                            <span class="text-xs">{{ $totalHit }} kali</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-xl p-4 shadow-sm flex flex-col space-y-2">
                <div class="flex items-center space-x-3">
                    <!-- Icon Box -->
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path>
                        </svg>
                    </div>

                    <div class="flex-1">
                    <a href="{{ route('nominatif.rekap.kol', [
                            'branch_code' => $selectedCab, 
                            'datadate' => implode(',', (array) request()->query('datadate', $datadates))
                        ]) }}">
                        <h3 class="text-sm font-bold mt-1">Rekap Per Kolektibilitas</h3>
                    </a>
                        <h3 class="text-sm font-bold mt-1">
                            <span class="font-normal text-gray-500">Rekap kredit per kolektibilitas {{ $selectedCabName }}</span>
                        </h3>
                    </div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-600 mt-1">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z">
                            </path>
                        </svg>
                        <span class="text-xs">{{ \Carbon\Carbon::parse($selectedDatadate)->format('d M Y') }}</span>
                    </div>

                    @php
                        $participants = 20;
                        $avatars = ['https://i.pravatar.cc/40?img=1', 'https://i.pravatar.cc/40?img=2', 'https://i.pravatar.cc/40?img=3'];
                    @endphp

                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            @foreach ($avatars as $avatar)
                                <img src="{{ $avatar }}" alt="avatar"
                                    class="w-6 h-6 rounded-full border-2 border-white object-cover">
                            @endforeach
                        </div>
                        <div class="flex items-center gap-1 text-gray-500">
                            <x-tabler-eye class="w-5 h-5 text-gray-500 text-xs" />
                            <span class="text-xs">{{ $totalHit }} kali</span>
                        </div>
                    </div>
                </div>

            </div>

        @endif

    </div>

@endsection
@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function datePicker() {
            return {
                selectedDate: '',
                minDate: '2024-01-01', // Set batas tanggal minimum (opsional)
                maxDate: new Date().toISOString().split("T")[0] // Otomatis set max ke hari ini
            };
        }
    </script>
@endpush
