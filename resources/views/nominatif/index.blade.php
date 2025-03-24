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
        <p class="text-sm leading-[21px] text-[#909DBF]">{{ number_format($totalRow) }} Debitur</p>
    </div>
</div>

<div class="flex flex-col gap-6 px-4 mt-[30px]">
    <div class="bg-white rounded-xl p-4 shadow-sm flex flex-col space-y-2">
        <div class="flex items-center space-x-3">
            <!-- Icon Box -->
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6l4 2"></path>
                </svg>
            </div>

            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <a href ="{{ route('nominatif.cabang', $user->branch?->branch_code) }}"><h3 class="text-sm font-bold mt-1">Nominatif Kredit</h3></a>
                </div>
                <h3 class="text-sm font-bold mt-1"><span class="font-normal text-gray-500">Daftar Nominatif kredit cabang Kragilan</span></h3>
            </div>
        </div>

        <div class="flex justify-between items-center text-sm text-gray-600 mt-1">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"></path>
                </svg>
                <span>24 Mar 2025</span>
            </div>
            @php
                $participants1 = 20;
                $avatars1 = [
                    'https://i.pravatar.cc/40?img=1',
                    'https://i.pravatar.cc/40?img=2',
                    'https://i.pravatar.cc/40?img=3',
                ];

                $participants2 = 15;
                $avatars2 = [
                    'https://i.pravatar.cc/40?img=4',
                    'https://i.pravatar.cc/40?img=5',
                ];
            @endphp
            <div class="flex items-center gap-2">
                <span>dilihat oleh 235 Org</span>
                <div class="flex -space-x-2">
                    @foreach($avatars1 as $avatar)
                        <img src="{{ $avatar }}" alt="avatar" class="w-6 h-6 rounded-full border-2 border-white object-cover">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('javascript')
    <script>
        localStorage.removeItem("image1");
        localStorage.removeItem("image2");
        localStorage.removeItem("image3");
        localStorage.removeItem("image4");
    </script>
@endpush
