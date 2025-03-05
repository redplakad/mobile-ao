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
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Nomor Kredit</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-id />
                    </div>
                    <input type="text" name="nomor_kredit" id="Name"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Nomor Rekening Kredit" required>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Nama Debitur</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-user />
                    </div>
                    <input type="text" name="nama_debitur" id="Name"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Nama Debitur" required>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">No Telepon</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-phone />
                    </div>
                    <input type="tel" name="no_telepon" id="Name"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Nomor Telepon Aktif" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="map" class="block text-sm font-medium text-gray-700">Lokasi Laporan</label>
                <div id="map" class="w-full h-64 border border-gray-300 rounded-md"></div>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="3"
                    class="w-full p-[12px_20px] rounded-md focus:ring focus:ring-blue-300 bg-white outline-none border-none placeholder-gray-400"
                    placeholder="Masukkan alamat lengkap"></textarea>
            </div>
            


            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Hasil Kunjungan</h2>
                <div class="flex items-center gap-2">
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Bayar</div>
                        <input type="radio" name="hasil_kunjungan" id="" class="absolute top-1/2 left-1/2 -z-10"
                            required>
                    </label>
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Tidak Bayar</div>
                        <input type="radio" name="hasil_kunjungan" id="" class="absolute top-1/2 left-1/2 -z-10"
                            required>
                    </label>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Uraian Kunjungan</label>
                <div
                    class="rounded-6 flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <textarea name="uraian_kunjungan" id="Name"
                        class="h-300 appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Uraian Kunjungan" required></textarea>
                </div>
            </div>
            <div id="CTA" class="w-full flex items-center justify-between bg-white">
                <button type="submit" class="rounded-full w-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">
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
            const latInput = document.getElementById("lat");
            const lngInput = document.getElementById("lng");
            const addressInput = document.getElementById("address");

            // Periksa apakah ada gambar di localStorage
            const storedImage = localStorage.getItem("image");
            
            // Jika ada gambar, gunakan gambar tersebut; jika tidak, gunakan placeholder
            imagePreview.src = storedImage ? storedImage : "{{ env('APP_URL') }}/assets/images/icons/placeholder.webp";

            if (!navigator.geolocation) {
                console.error("Geolocation is not supported by this browser.");
                return;
            }

            navigator.geolocation.getCurrentPosition(async (position) => {
                const { latitude: lat, longitude: lng } = position.coords;
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
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
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
