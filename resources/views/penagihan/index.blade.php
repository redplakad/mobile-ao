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
            <p class="text-sm leading-[21px] text-[#909DBF]">{{ count($penagihan) }} Debitur</p>
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
        
        @forelse ($penagihan as $data)
        <a href="{{ route('penagihan.detail', $data->uuid) }}" class="card">
            <div
                class="flex flex-col gap-4 rounded-[20px] ring-1 ring-[#E9E8ED] pb-4 bg-white overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                <div class="w-full h-[180px] relative overflow-hidden">
                    <img src="{{ $data->image }}" alt="Gambar"
                        class="w-full h-full object-cover overlay object-center" />
                    <p class="absolute top-4 right-4 rounded-md px-2 py-1 text-white text-xs font-semibold shadow-sm
                        {{ $data->hasil_kunjungan == 'Tidak Bayar' ? 'bg-gray-400' : 'bg-green-500' }}">
                        {{ ucfirst($data->hasil_kunjungan) }}
                    </p>
                    
                    
                </div>              
                <p class="text-xs text-gray-500 px-4">
                    {{ $data->user->name ?? 'User tidak ditemukan' }} • {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                </p>
                
      
                <div class="flex items-center justify-between gap-4 px-4">
                    <div class="title flex flex-col gap-[6px]">
                        <div class="flex items-center gap-1">
                            <h1 class="font-semibold w-fit"> {{ $data['nama_debitur'] }} </h1>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <div class="w-4 h-4 flex shrink-0">
                                <img src="assets/images/icons/location.svg" alt="icon">
                            </div>
                            <p class="text-sm leading-[21px] text-[#909DBF]">{{ Str::limit($data->address, 60, '...') }}
                            </p>
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
    @empty
        <div class="flex flex-col items-center justify-center text-center p-6 w-full h-[300px] bg-white border border-dashed border-gray-300 rounded-[20px] shadow-sm">
            <div class="w-24 h-24 mb-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-600 mb-1">Belum Ada Data</h2>
            <p class="text-sm text-gray-500 max-w-sm">Data penagihan belum tersedia saat ini. Silakan tambahkan data terlebih dahulu atau periksa kembali nanti.</p>
        </div>
    @endforelse
    
    </section>
@endsection
@push("javascript")
    <script>
        localStorage.removeItem("image");
    </script>
@endpush