@extends('layouts.no-nav')
@section('content')
<div class="container">
    <h4>Import CSV ke Tabel Nominatif</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('nominatif.import.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class=" max-w-screen-sm mx-auto p-4 flex flex-col gap-4 mt-5"
            <div class="bg-white">
                <div class="mb-3">
                    <label for="datadate" class="form-label">Data Date</label>
                    <input type="date" name="datadate" class="form-control" required>
                </div>

                <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">File CSV</label>
                <div class="mt-2 mx-4 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm/6 text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                        <span>Upload file </span>
                        <input id="file-upload" name="csv_file" type="file" class="sr-only" accept=".csv" required>
                    </label>
                    <p class="pl-1"> &nbsp;atau drag and drop</p>
                    </div>
                    <p class="text-xs/5 text-gray-600">CSV File</p>
                </div>
                </div>
            </div>

            <button type="submit" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                Import
            </button>
        </div>
    </form>
</div>
@endsection
