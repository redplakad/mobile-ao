@extends('layouts.second')
@section('content')
    <div class="flex h-full flex-1 mt-5">
        <form action="payment.html"
            class="w-full flex flex-col rounded-t-[10px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto">
            @csrf
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
                <label for="Name" class="font-semibold">Nama Pengguna</label>
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
                <label for="Name" class="font-semibold">Kata Sandi</label>
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
            <div id="CTA" class="w-full flex items-center justify-between bg-white">
                <button type="submit" class="rounded-full w-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">
                    Masuk
                </button>
            </div>
        </form>
    </div>
@endsection
