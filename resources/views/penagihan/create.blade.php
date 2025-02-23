@extends('layouts.second')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-5">
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
        <form action="payment.html"
            class="w-full flex flex-col rounded-t-[10px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto">

            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">

            <div class="flex flex-col gap-2">
                <img alt="image" id="image-preview" class="img-fluid rounded-2">
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
                    <input type="text" name="" id="Name"
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
                    <input type="text" name="" id="Name"
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
                    <input type="tel" name="" id="Name"
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
                <textarea class="w-full p-[12px_20px] border border-gray-300 rounded-md focus:ring focus:ring-blue-300" id="address"
                    name="address" rows="3"></textarea>
            </div>


            <div class="flex flex-col gap-2">
                <h2 class="font-semibold">Hasil Kunjungan</h2>
                <div class="flex items-center gap-2">
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Bayar</div>
                        <input type="radio" name="day" id="" class="absolute top-1/2 left-1/2 -z-10"
                            required>
                    </label>
                    <label class="!w-fit group relative">
                        <div
                            class="rounded-full !w-fit border border-[#E9E8ED] p-[12px_20px] font-semibold transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white group-has-[:checked]:bg-[#5B86EF] group-has-[:checked]:text-white group-has-[:disabled]:bg-[#EEEFF4] group-has-[:disabled]:text-[#AAADBF]">
                            Tidak Bayar</div>
                        <input type="radio" name="day" id="" class="absolute top-1/2 left-1/2 -z-10"
                            required>
                    </label>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="Name" class="font-semibold">Uraian Kunjungan</label>
                <div
                    class="rounded-6 flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <textarea name="" id="Name"
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
        var image = localStorage.getItem('image');
        var imagePreview = document.getElementById('image-preview');

        // Gunakan gambar dari localStorage jika ada, jika tidak gunakan placeholder
        imagePreview.src = image ? image : "{{ env('APP_URL') }}/assets/images/icons/placeholder.webp";

        var map = document.getElementById('map');
        var lattitude = document.getElementById('lat');
        var longitude = document.getElementById('lng');
        var address = document.getElementById('address');

        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            lattitude.value = lat;
            longitude.value = lng;

            var mymap = L.map('map').setView([lat, lng], 13);

            var marker = L.marker([lat, lng]).addTo(mymap);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(mymap);

            var geocodingUrl =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

            fetch(geocodingUrl)
                .then(response => response.json())
                .then(data => {
                    address.value = data.display_name;
                    marker.bindPopup(`<b>Lokasi Laporan</b><br />Kamu berada di ${data.display_name}`)
                        .openPopup();
                })
                .catch(error => console.error('Error fetching reverse geocoding data:', error));
        });
    </script>
@endpush
