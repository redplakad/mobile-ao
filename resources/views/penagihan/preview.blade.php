@extends('layouts.no-nav')

@section('content')
    <div class="max-w-screen-sm mx-auto bg-white min-h-screen p-3 flex flex-col items-center">
        <img alt="image" id="image-preview" class="w-full max-w-xs rounded-lg shadow">

        <div class="flex h-full flex-1 mt-5">
            <div class="flex flex-col item-center gap-2">
                <a href="{{ route('penagihan.create') }}"
                    class="rounded-full flex ring-1 ring-[#E9E8ED] p-[12px_16px]  bg-[#FF8E62] text-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62] justify-center font-bold">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-check />
                    </div>
                    Gunakan Foto Ini
                </a>
                <a href="{{ route('penagihan.take') }}"
                    class="rounded-full flex ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62] justify-center font-bold">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-repeat />
                    </div>
                    Ambil Foto ulang
                </a>
            </div>

        </div>
    </div>
@endsection

@push('javascript')
    <script>
        var image = localStorage.getItem('image1');
        var imagePreview = document.getElementById('image-preview');
        imagePreview.src = image;
    </script>
@endpush
