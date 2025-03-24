@extends('layouts.app')

@section('title', 'SMAR AO | PT BPR SERANG - Sistem Monitoring & Analisa Realtime & Terintegrasi AO')

@section('content')
    <div class="bg-[#01017a] absolute top-0 max-w-[640px] w-full mx-auto rounded-b-[50px] h-[370px]"></div>
    <form action="" class="flex flex-col gap-6 mt-6 relative z-10">
        <div class="flex flex-col gap-2 px-4">
            <label for="Location" class="font-semibold text-white">Pencarian</label>
            <div
                class="rounded-full flex items-center p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                <div class="w-6 h-6 flex shrink-0 mr-[6px]">
                    <x-tabler-search />
                </div>
                <input type="text" name="keyword" placeholder="Pencarian Nama debitur"
                    class="w-full border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent">
            </div>
        </div>
        <section id="Services" class="flex flex-col gap-3 px-4">
            <h1 class="font-semibold text-white">Selamat Datang Galih.</h1>
            <div class="grid grid-cols-3 gap-4">
                <a href="{{ route('penagihan.index') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/penagihan.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Penagihan</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">25 Debitur</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pages.404') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/survey.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Survey</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">6 Bekas</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pages.404') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/desk.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Desk Coll</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">18 Aksi</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('nominatif.index') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/nominatif.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Nominatif</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">173 Debitur</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pages.404') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/analisa.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Analisa</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">17 Berkas</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pages.404') }}" class="card-services">
                    <div
                        class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-2 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                        <div class="w-[50px] h-[50px] flex shrink-0">
                            <img src="assets/images/icons/tugas.png" alt="icon">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">Tugas</p>
                            <p class="text-xs leading-[18px] text-[#909DBF]">12 Tugas</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </form>

    <section id="Promo" class="flex flex-col gap-3 px-4 mt-6 relative z-10">
        <h1 class="font-semibold"></h1>
        <div class="rounded-2xl border border-[#E9E8ED] flex items-center justify-between p-4 bg-white">
            <div class="flex items-center gap-[10px]">
                <div class="w-[60px] h-[60px] flex shrink-0">
                    <img src="assets/images/photos/avatar.png" alt="icon">
                </div>
                <div class="flex flex-col h-fit">
                    <p class="font-semibold">{{ $user->name }}</p>
                    <p class="text-sm leading-[21px] text-[#909DBF]">{{ $user->branch?->branch_name }}</p>
                </div>
            </div>
            <div x-data="{ open: false }" class="relative z-10 inline-block text-left">
                <div>
                  <button @click="open = !open" type="button"
                    class="flex items-center rounded-full bg-gray-100 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                    id="menu-button" aria-expanded="true" aria-haspopup="true">
                    <span class="sr-only">Open options</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                    </svg>
                  </button>
                </div>
              
                <div x-show="open" @click.away="open = false"
                  x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95"
                  class="absolute right-0 z-20 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                  <div class="py-1" role="none">      
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" role="none">
                        @csrf
                      <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Keluar</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </section>

    <section id="Profile" class="flex flex-col gap-3 px-4 mt-3">
        <h1 class="font-semibold"></h1>
        <div class="rounded-2xl border border-[#E9E8ED] flex items-center justify-between p-4 bg-white">
            <table class="w-full mt-2 text-sm">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <th class="px-1 py-2 text-left">Kolektibilitas</th>
                        <th class="px-1 py-2 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-300">
                        <td class="px-1 py-2">Lancar</td>
                        <td class="px-1 py-2 text-right">7,060,000,000</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="px-1 py-2">DPK</td>
                        <td class="px-1 py-2 text-right">200</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="px-1 py-2">Kurang Lancar</td>
                        <td class="px-1 py-2 text-right">1,000</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="px-1 py-2">Diragukan</td>
                        <td class="px-1 py-2 text-right">800</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="px-1 py-2">Macet</td>
                        <td class="px-1 py-2 text-right">200</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>
@endsection
@push('javascript')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush