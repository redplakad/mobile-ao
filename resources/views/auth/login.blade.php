@extends('layouts.third')

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
                <label for="nomor_kredit" class="block text-sm font-medium leading-6 text-gray-900">Email Pengguna</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                          </svg>
                    </div>
                    <input type="text" name="email" id="email"
                        value="{{ old('nomor_kredit') }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" 
                        placeholder="Ketikan email pengguna"
                    required>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="nomor_kredit" class="block text-sm font-medium leading-6 text-gray-900">Kata Sandi</label>
                <div class="relative mt-2 rounded-full shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                    </div>
                    <input type="text" name="password" id="password"
                        value="{{ old('nomor_kredit') }}"
                        class="block w-full rounded-full border-0 py-4 pl-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" 
                        placeholder="Ketikan kata sandi"
                    required>
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