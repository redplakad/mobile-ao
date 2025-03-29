@extends('layouts.second')

@section('title', 'Import Nominatif')
@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-10">
        <a href="{{ route('front.index') }}">
            <div class="w-10 h-10 flex shrink-0">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Notifikasi</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]">Lihat Notifikasi</p>
        </div>
        <a href="{{ route('dashboard') }}"class="w-10 h-10 flex shrink-0">
            <div class="w-10 h-10 flex shrink-0 ml-4">
                <x-tabler-square-plus />
            </div>
        </a>
    </div>
    <div class="max-w-screen-lg mx-auto p-6 bg-white shadow-sm rounded-lg mt-10">
        <h4 class="text-2xl font-bold text-gray-800 mb-6">Import CSV ke Tabel Nominatif</h4>
    
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('nominatif.import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
    
            <!-- Input Tanggal -->
            <div>
                <label for="datadate" class="block text-sm font-medium text-gray-700 mb-1">Data Date</label>
                <input type="date" name="datadate" id="datadate" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
    
            <!-- Input File CSV -->
            <div>
                <label for="csv_file" class="block text-sm font-medium text-gray-700 mb-1">File CSV</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10 bg-gray-50">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm text-gray-600">
                            <label for="csv_file" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                <span>Upload file</span>
                                <input id="csv_file" name="csv_file" type="file" accept=".csv" class="sr-only" required>
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Format file yang diterima: .csv</p>
                    </div>
                </div>
            </div>
    
            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-x-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    Import
                </button>
            </div>
        </form>
    </div>
    
</div>
@endsection
