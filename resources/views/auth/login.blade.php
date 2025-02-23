@extends('layouts.second')

@section('content')
    <header class="flex flex-col gap-3 items-center text-center pt-10 relative z-10">
        <div class="flex shrink-0">
        <img src="{{ asset('assets/images/logos/logo-black.png') }}" alt="logo" style="height: 42px;">
        </div>
        <p class="text-sm leading-[21px] text-black">Sistem Monitoring Realtime & Terintegrasi AO</p>
    </header>

    <div class="flex h-full flex-1 mt-5">
        <form method="POST" action="{{ route('login') }}"
            class="w-full flex flex-col rounded-t-[10px] p-5 pt-[30px] gap-[26px] bg-white overflow-x-hidden mb-0 mt-auto">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Nomor Kredit -->

            <!-- Nama Pengguna -->
            <div class="flex flex-col gap-2">
                <label for="username" class="font-semibold">Email</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-user />
                    </div>
                    <input type="text" name="email" id="email"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Email" value="{{ old('email') }}" required>
                </div>
            </div>

            <!-- Kata Sandi -->
            <div class="flex flex-col gap-2">
                <label for="password" class="font-semibold">Kata Sandi</label>
                <div
                    class="rounded-full flex items-center ring-1 ring-[#E9E8ED] p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                    <div class="w-6 h-6 flex shrink-0 mr-[10px]">
                        <x-tabler-lock />
                    </div>
                    <input type="password" name="password" id="password"
                        class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#909DBF]"
                        placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Tombol Masuk -->
            <div id="CTA" class="w-full flex items-center justify-between bg-white">
                <button type="submit"
                    class="rounded-full w-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">
                    Masuk
                </button>
            </div>

            <!-- Forgot Password -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection