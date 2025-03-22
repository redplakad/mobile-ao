@extends('layouts.no-nav')

@section('content')
<div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
    <a href="{{ isset($_REQUEST['edit']) ? route('penagihan.edit', $_REQUEST['edit']) : route('penagihan.create') }}">
        <div class="w-10 h-10 flex shrink-0">
            <x-tabler-arrow-narrow-left />
        </div>
    </a>
    <div class="flex flex-col w-fit text-center">
        <h1 class="font-semibold text-lg leading-[27px]">Ambil Gambar</h1>
        <p class="text-sm leading-[21px] text-[#909DBF]">Foto & Dokumentasi Penagihan</p>
    </div>
    <a href="{{ route('front.index') }}" class="w-10 h-10 flex shrink-0">
        <div class="w-10 h-10 flex shrink-0 ml-4">
            <x-tabler-x />
        </div>
    </a>
</div>
<div class="max-w-screen-sm mx-auto min-h-screen p-4 flex flex-col gap-4 mt-5">

    @php
        $photoItems = [
            ['label' => 'Foto Debitur', 'id' => 1, 'alt' => 'Foto Debitur'],
            ['label' => 'Lokasi Penagihan', 'id' => 2, 'alt' => 'Lokasi Penagihan'],
            ['label' => 'Foto Debitur & Petugas', 'id' => 3, 'alt' => 'Foto Debitur dan Petugas'],
            ['label' => 'Foto Lainnya', 'id' => 4, 'alt' => 'Foto Lainnya'],
        ];
    @endphp

    @foreach($photoItems as $item)
    <div class="bg-white border border-gray-200 rounded-xl shadow p-4 flex flex-col items-center gap-3">
        <h3 class="text-base font-semibold text-center">{{ $item['label'] }}</h3>
        <img id="image-preview{{ $item['id'] }}"
             class="w-full max-w-sm h-auto object-cover rounded-lg shadow-sm border border-gray-100"
             src="{{ asset('assets/images/icons/placeholder.webp') }}"
             alt="{{ $item['alt'] }}">
             <a href="{{ route('penagihan.snapshot', ['image' => $item['id']]) }}{{ isset($_REQUEST['edit']) ? '?edit='.$_REQUEST['edit'] : '' }}"
                class="inline-flex items-center justify-center w-full rounded-full ring-1 ring-[#E9E8ED] px-4 py-2 bg-white transition-all duration-300 focus-visible:ring-2 focus-visible:ring-[#FF8E62] font-bold hover:bg-gray-50">
                 <span class="mr-2"><x-tabler-camera /></span>
                 Ambil Foto
             </a>
    </div>
    @endforeach
    <a href="{{ isset($_REQUEST['edit']) ? route('penagihan.edit', $_REQUEST['edit']) : route('penagihan.create') }}"
        class="inline-flex items-center justify-center w-full rounded-full ring-1 ring-[#E9E8ED] px-4 py-2 bg-white transition-all duration-300 focus-visible:ring-2 focus-visible:ring-[#FF8E62] font-bold hover:bg-gray-50">
         <span class="mr-2"><x-tabler-arrow-narrow-left /></span>
         Kembali
    </a>

</div>
@endsection

@push('javascript')
<script>
    // Cek localStorage untuk masing-masing image preview
    for (let i = 1; i <= 4; i++) {
        const imgData = localStorage.getItem('image' + i);
        const imgEl = document.getElementById('image-preview' + i);
        if (imgData) {
            imgEl.src = imgData;
        }
    }
</script>
@endpush
