@extends('layouts.second')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('penagihan.detail', $penagihan->uuid) }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Edit Penagihan</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Ubah laporan penagihan</p>
        </div>
        <a href="{{ route('front.index') }}" class="w-10 h-10 flex shrink-0 ml-4">
            <x-tabler-x />
        </a>
    </div>

    <div class="flex h-full flex-1 mt-5">
        <form action="{{ route('penagihan.update', $penagihan->uuid) }}"
            class="w-full flex flex-col rounded-t-[10px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto"
            method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">
            @php
                $imageColumnMap = [
                    1 => 'image',
                    2 => 'image1',
                    3 => 'image2',
                    4 => 'image3',
                ];
            @endphp
            
            <input type="hidden" id="image1" name="image" value="{{ $penagihan->{$imageColumnMap[1]} ?? '' }}">
            <input type="hidden" id="image2" name="image1" value="{{ $penagihan->{$imageColumnMap[2]} ?? '' }}">
            <input type="hidden" id="image3" name="image2" value="{{ $penagihan->{$imageColumnMap[3]} ?? '' }}">
            <input type="hidden" id="image4" name="image3" value="{{ $penagihan->{$imageColumnMap[4]} ?? '' }}">
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4" role="alert">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="mt-2 space-y-1 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex gap-1">
                <img data-default="{{ !empty($penagihan->image) ? $penagihan->image : asset('assets/images/icons/placeholder.webp') }}"
                    class="w-16 h-16 object-cover" alt="Image 1" id="imagePreview1">
                <img data-default="{{ !empty($penagihan->image1) ? $penagihan->image1 : asset('assets/images/icons/placeholder.webp') }}"
                    class="w-16 h-16 object-cover" alt="Image 2" id="imagePreview2">
                <img data-default="{{ !empty($penagihan->image2) ? $penagihan->image2 : asset('assets/images/icons/placeholder.webp') }}"
                    class="w-16 h-16 object-cover" alt="Image 3" id="imagePreview3">
                <img data-default="{{ !empty($penagihan->image3) ? $penagihan->image3 : asset('assets/images/icons/placeholder.webp') }}"
                    class="w-16 h-16 object-cover" alt="Image 4" id="imagePreview4">
            </div>

            <div class="flex flex-col item-center gap-2">
                <a href="{{ route('penagihan.take', ['edit' => $penagihan->uuid]) }}"
                    class="rounded-full flex ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62] justify-center font-bold">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-camera />
                    </div>
                    Foto Penagihan
                </a>
            </div>

            <div>
                <label for="nomor_kredit" class="block text-sm font-medium leading-6 text-gray-900">Nomor Kredit</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <!-- SVG ICON -->
                    </div>
            
                    @if(request()->routeIs('penagihan.edit'))
                        <!-- disabled input (hanya tampilan) -->
                        <input type="text" id="nomor_kredit_display"
                            value="{{ old('nomor_kredit', $penagihan->nomor_kredit) }}" disabled
                            class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6
                                disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed disabled:ring-gray-200 disabled:opacity-70" />
            
                        <!-- hidden input untuk dikirim ke server -->
                        <input type="hidden" name="nomor_kredit"
                            value="{{ old('nomor_kredit', $penagihan->nomor_kredit) }}">
                    @else
                        <input type="text" name="nomor_kredit" id="nomor_kredit"
                            value="{{ old('nomor_kredit', $penagihan->nomor_kredit) }}"
                            class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                            placeholder="007300012345" required />
                    @endif
                </div>
            </div>
            
            <div>
                <label for="nama_debitur" class="block text-sm font-medium leading-6 text-gray-900">Nama Debitur</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <!-- SVG ICON -->
                    </div>
            
                    @if(request()->routeIs('penagihan.edit'))
                        <input type="text" id="nama_debitur_display"
                            value="{{ old('nama_debitur', $penagihan->nama_debitur) }}" disabled
                            class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6
                                disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed disabled:ring-gray-200 disabled:opacity-70" />
                        <input type="hidden" name="nama_debitur"
                            value="{{ old('nama_debitur', $penagihan->nama_debitur) }}">
                    @else
                        <input type="text" name="nama_debitur" id="nama_debitur"
                            value="{{ old('nama_debitur', $penagihan->nama_debitur) }}"
                            class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                            placeholder="Nama Lengkap" required />
                    @endif
                </div>
            </div>
            

            <div>
                <label for="no_telepon" class="block text-sm font-medium leading-6 text-gray-900">No Telepon</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>


                    </div>
                    <input type="text" name="no_telepon" id="no_telepon"
                        value="{{ old('no_telepon', $penagihan->no_telepon) }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6
                                disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed disabled:ring-gray-200 disabled:opacity-70"
                        placeholder="081234567890" required />
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Hasil Kunjungan</h2>
                <div class="flex items-center gap-2">
                    <!-- Option: Bayar -->
                    <label class="group relative cursor-pointer">
                        <input type="radio" name="hasil_kunjungan" value="Bayar" class="sr-only peer"
                            {{ old('hasil_kunjungan', $penagihan->hasil_kunjungan) == 'Bayar' ? 'checked' : '' }} required>
                        <div
                            class="rounded-full border border-[#E9E8ED] px-5 py-3 font-semibold transition-all duration-300 bg-white text-[#333]
                                   peer-checked:bg-[#5B86EF] peer-checked:text-white
                                   peer-disabled:bg-[#EEEFF4] peer-disabled:text-[#AAADBF]">
                            Bayar
                        </div>
                    </label>

                    <!-- Option: Tidak Bayar -->
                    <label class="group relative cursor-pointer">
                        <input type="radio" name="hasil_kunjungan" value="Tidak Bayar" class="sr-only peer"
                            {{ old('hasil_kunjungan', $penagihan->hasil_kunjungan) == 'Tidak Bayar' ? 'checked' : '' }}
                            required>
                        <div
                            class="rounded-full border border-[#E9E8ED] px-5 py-3 font-semibold transition-all duration-300 bg-white text-[#333]
                                   peer-checked:bg-[#5B86EF] peer-checked:text-white
                                   peer-disabled:bg-[#EEEFF4] peer-disabled:text-[#AAADBF]">
                            Tidak Bayar
                        </div>
                    </label>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="janji_bayar" class="block text-sm font-medium text-gray-900">Janji Bayar?</label>
                <div class="flex items-center gap-2">
                    <label class="group relative cursor-pointer">
                        <input type="radio" name="is_janji_bayar" value="iya" class="sr-only peer"
                            {{ !empty(old('is_janji_bayar', $penagihan->janji_bayar)) ? 'checked' : '' }}>
                        <div
                            class="rounded-full border px-5 py-3 font-semibold transition-all peer-checked:bg-[#5B86EF] peer-checked:text-white">
                            Iya
                        </div>
                    </label>
                    <label class="group relative cursor-pointer">
                        <input type="radio" name="is_janji_bayar" value="tidak" class="sr-only peer" {
                            {{ empty(old('is_janji_bayar', $penagihan->janji_bayar)) ? 'checked' : '' }}>
                        <div
                            class="rounded-full border px-5 py-3 font-semibold transition-all peer-checked:bg-[#5B86EF] peer-checked:text-white">
                            Tidak
                        </div>
                    </label>
                </div>
            </div>

            {{-- Field Janji Bayar Date --}}
            <div id="janjiBayarContainer" class="mt-4 hidden">
                <label for="janji_bayar" class="block text-sm font-medium text-gray-900">Tanggal Janji Bayar</label>
                <input type="date" name="janji_bayar" id="janji_bayar"
                    value="{{ old('janji_bayar', isset($penagihan) ? $penagihan->janji_bayar : '') }}"
                    class="block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
            </div>



            <div>
                <label for="catatan" class="block text-sm font-medium leading-6 text-gray-900">Catatan Kunjungan</label>
                <div class="mt-2">
                    <textarea rows="4" name="uraian_kunjungan" id="address"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6
                                disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed disabled:ring-gray-200 disabled:opacity-70"
                        placeholder="Deskripsikan hasil kunjungan." required>{{ old('uraian_kunjungan', $penagihan->uraian_kunjungan) }}</textarea>
                </div>
            </div>

            <div id="CTA" class="w-full flex items-center justify-between bg-white">
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-x-2 rounded-full bg-blue-600 px-3.5 py-4 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-200 ease-in-out
                            disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed disabled:opacity-70">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>


                    Simpan Perubahan
                </button>


            </div>
        </form>
    </div>
@endsection
@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/booking.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radioIya = document.querySelector('input[name="is_janji_bayar"][value="iya"]');
            const radioTidak = document.querySelector('input[name="is_janji_bayar"][value="tidak"]');
            const janjiBayarContainer = document.getElementById("janjiBayarContainer");

            function toggleJanjiBayarField() {
                if (radioIya.checked) {
                    janjiBayarContainer.classList.remove('hidden');
                } else {
                    janjiBayarContainer.classList.add('hidden');
                }
            }

            if (radioIya && radioTidak) {
                radioIya.addEventListener('change', toggleJanjiBayarField);
                radioTidak.addEventListener('change', toggleJanjiBayarField);

                // Initial toggle on page load
                toggleJanjiBayarField();
            }
        });
    </script>

    {{-- Script untuk cek image local --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const defaultImage = "{{ asset('assets/images/icons/placeholder.webp') }}";

            for (let i = 1; i <= 4; i++) {
                const imgEl = document.getElementById('imagePreview' + i);
                const localImg = localStorage.getItem('image' + (i)); // image0 to image3

                if (localImg) {
                    imgEl.src = localImg;
                } else if (imgEl.dataset.default) {
                    imgEl.src = imgEl.dataset.default;
                } else {
                    imgEl.src = defaultImage;
                }
            }
        });
    </script>

    {{-- Pengecekan image untuk hidden input --}}
    <script>
        for (let i = 1; i <= 4; i++) {
            const localImage = localStorage.getItem('image' + i);
            const inputEl = document.getElementById('image' + i);
            if (localImage && inputEl) {
                inputEl.value = localImage;
            }
        }
    </script>
@endpush
