@extends('layouts.second')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('penagihan.index') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Buat Penagihan</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Buat laporan penagihan baru</p>
        </div>
        <a href="{{ route('front.index') }}" class="w-10 h-10 flex shrink-0">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-x />
            </div>
        </a>
    </div>
    <div class="flex h-full flex-1 mt-5">
        <form action="{{ route('penagihan.store') }}"
            class="w-full flex flex-col rounded-t-[10px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto"
            method="POST">
            @csrf
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">
            <input type="hidden" id="image" name="image">
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



            <div class="flex flex-col gap-2">
                <img alt="" id="image-preview" class="img-fluid rounded-2">
            </div>
            <div class="flex flex-col item-center gap-2">
                <a href="{{ route('penagihan.take') }}"
                    class="rounded-full flex ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62] justify-center font-bold">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-camera />
                    </div>
                    Ambil Foto Debitur
                </a>
            </div>
            <div>
                <label for="nomor_kredit" class="block text-sm font-medium leading-6 text-gray-900">Nomor Kredit</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>

                    </div>
                    <input type="text" name="nomor_kredit" id="nomor_kredit"
                        value="{{ old('nomor_kredit') }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                        placeholder="007300012345" required>
                </div>
            </div>

            <div>
                <label for="nama_debitur" class="block text-sm font-medium leading-6 text-gray-900">Nama Debitur</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                    </div>
                    <input type="text" name="nama_debitur" id="nama_debitur"
                        value="{{ old('nama_debitur') }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                        placeholder="Nama Lengkap" required>
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
                        value="{{ old('no_telepon') }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                        placeholder="087770112233" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="map" class="block text-sm font-medium text-gray-700">Lokasi Laporan</label>
                <div id="map" class="w-full h-64 border border-gray-300 rounded-md"></div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat Lengkap</label>
                <div class="mt-2">
                    <textarea rows="4" name="address" id="address"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" required>
                    </textarea>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Hasil Kunjungan</h2>
                <div class="flex items-center gap-2">
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Bayar</div>
                        <input type="radio" name="hasil_kunjungan" id=""
                            class="absolute top-1/2 left-1/2 -z-10" 
                            {{ old('hasil_kunjungan') == 'Bayar' ? 'checked' : '' }} required>
                    </label>
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Tidak Bayar</div>
                        <input type="radio" name="hasil_kunjungan" id=""
                            class="absolute top-1/2 left-1/2 -z-10" 
                            {{ old('hasil_kunjungan') == 'Tidak Bayar' ? 'checked' : '' }} required>
                    </label>
                </div>
            </div>

            <div>
                <label for="catatan" class="block text-sm font-medium leading-6 text-gray-900">Catatan Kunjungan</label>
                <div class="mt-2">
                    <textarea rows="4" name="uraian_kunjungan" id="catatan"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" required>{{ old('uraian_kunjungan') }}</textarea>
                </div>
            </div>

            <div id="CTA" class="w-full flex items-center justify-between bg-white">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-x-2 rounded-full bg-blue-600 px-3.5 py-4 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-200 ease-in-out">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    Simpan
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
        document.addEventListener("DOMContentLoaded", async () => {
            const imagePreview = document.getElementById("image-preview");
            const image = document.getElementById("image");
            const latInput = document.getElementById("lat");
            const lngInput = document.getElementById("lng");
            const addressInput = document.getElementById("address");

            // Periksa apakah ada gambar di localStorage
            const storedImage = localStorage.getItem("image");

            // Jika ada gambar, gunakan gambar tersebut; jika tidak, gunakan placeholder

            image.value = storedImage;
            imagePreview.src = storedImage ? storedImage:
                "{{ env('APP_URL') }}/assets/images/icons/placeholder.webp";

            if (!navigator.geolocation) {
                console.error("Geolocation is not supported by this browser.");
                return;
            }

            navigator.geolocation.getCurrentPosition(async (position) => {
                const {
                    latitude: lat,
                    longitude: lng
                } = position.coords;
                latInput.value = lat;
                lngInput.value = lng;

                // Inisialisasi peta
                const map = L.map("map").setView([lat, lng], 13);
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "Map data &copy; <a href='https://www.openstreetmap.org/'>OpenStreetMap</a> contributors",
                    maxZoom: 18,
                }).addTo(map);

                const marker = L.marker([lat, lng]).addTo(map);

                // Ambil alamat dari koordinat
                fetchReverseGeocoding(lat, lng, marker, addressInput);
            }, (error) => {
                console.error("Geolocation error:", error.message);
            });
        });

        async function fetchReverseGeocoding(lat, lng, marker, addressInput) {
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`
                );
                const data = await response.json();

                if (data.display_name) {
                    addressInput.value = data.display_name;
                    marker.bindPopup(`<b>Lokasi Laporan</b><br />Kamu berada di ${data.display_name}`).openPopup();
                }
            } catch (error) {
                console.error("Error fetching reverse geocoding data:", error);
            }
        }
    </script>
@endpush
