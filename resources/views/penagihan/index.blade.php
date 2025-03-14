@extends('layouts.second')

@section('title', 'Daftar Penagihan')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('front.index') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Daftar Penagihan</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">18 Debitur</p>
        </div>
        <a href="./penagihan/create"class="w-10 h-10 flex shrink-0">
            <div class="w-10 h-10 flex shrink-0 ml-4">
                <x-tabler-square-plus />
            </div>
        </a>
    </div>

    <section id="Store-list" class="flex flex-col gap-6 px-4 mt-[30px]">
        @if(session('success'))
            <div class="alert-success">
                <span class="alert-icon">✔</span>
                <span class="alert-message">
                    {{ session('success') }}
                </span>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif
        
        <a href="details.html" class="card">
            <div
                class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                <div class="w-full h-[120px] flex shrink-0 overflow-hidden relative">
                    <img src="assets/images/thumbnails/th-details-1.png" class="w-full h-full object-cover"
                        alt="thumbnail">
                    <p
                        class="rounded-full p-[6px_10px] bg-[#41BE64] w-fit h-fit font-bold text-[10px] leading-[15px] text-white absolute top-4 right-4">
                        Bayar</p>
                </div>
                <div class="flex items-center justify-between gap-4 px-4">
                    <div class="title flex flex-col gap-[6px]">
                        <div class="flex items-center gap-1">
                            <h1 class="font-semibold w-fit">Ari Andari</h1>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="assets/images/icons/verify.svg" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <div class="w-4 h-4 flex shrink-0">
                                <img src="assets/images/icons/location.svg" alt="icon">
                            </div>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Kp Nambo, ciruas</p>
                        </div>
                    </div>
                    <div class="rating flex flex-col gap-[6px]">
                        <div class="flex items-center justify-end text-right gap-[6px]">
                            <h1 class="font-semibold w-fit">Kol 2</h1>
                        </div>
                        <div class="flex items-center justify-end text-right gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">Galih</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </section>
@endsection
@push("javascript")
    <script>
        localStorage.removeItem("image");
    </script>
@endpush