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
             <a href="store-list.html" class="card-services">
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
             <a href="store-list.html" class="card-services">
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
             <a href="store-list.html" class="card-services">
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
             <a href="store-list.html" class="card-services">
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
             <a href="store-list.html" class="card-services">
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
                 <p class="font-semibold">Galih Setiabudi</p>
                 <p class="text-sm leading-[21px] text-[#909DBF]">Kantor Cabang Kragilan</p>
             </div>
         </div>
     </div>
 </section>


 <section id="Promo" class="flex flex-col gap-3 px-4 mt-3 relative z-10">
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