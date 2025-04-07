@extends('layouts.second')
@section('content')
    <div id="Top-nav" class="relative flex items-center justify-between px-4 pt-10">
        <!-- Back Button -->
        <a href="{{ route('nominatif.index') }}">
            <div class="w-10 h-10 flex shrink-0 items-center">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>

        <!-- Title Centered -->
        <div class="absolute left-1/2 top-10 transform -translate-x-1/2 text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Rekap Produk</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]"></p>
        </div>
    </div>
    <div class="w-full mx-auto px-4 py-8">

        {{-- Card Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div class="bg-blue-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Debitur</h3>
                <p class="text-sm font-extrabold">{{ number_format($sumDeb, 0, ',', '.') }}</p>
            </div>
            
            <div class="bg-green-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Bakidebet</h3>
                <p class="text-sm font-extrabold">Rp {{ number_format($sumBaki, 0, ',', '.') }}</p>
            </div>

            <div class="bg-yellow-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Total NPL</h3>
                <p class="text-sm font-extrabold">{{ number_format($sumNPL, 0, ',', '.') }}</p>
            </div>

            <div class="bg-red-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">NPL</h3>
                <p class="text-sm font-extrabold">{{ number_format(($sumNPL / $sumBaki) * 100, 2, ',', '.') }}%</p>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-xs">
                        <th class="px-2 py-3">Produk</th>
                        <th class="px-2 py-3">Deb</th>
                        <th class="px-2 py-3">Bakidebet</th>
                        <th class="px-2 py-3">NPL</th>
                        <th class="px-2 py-3">#</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($recapData as $data)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="px-2 py-3 text-xs">
                                <a href="{{ route('nominatif.cabang', [
                                    'branch_code' => $branch_code, 
                                    'datadate' => implode(',', (array) request()->query('datadate', $datadate)),
                                    'produk' => urlencode($data->KET_KD_PRD),
                                    'recap' => 'nominatif.rekap.produk'
                                ]) }}">
                                    {{ $data->KET_KD_PRD ?? 'Unknown' }}
                                </a>
                            </td>
                            <td class="px-2 py-3 text-gray-700 text-xs">{{ number_format($data->total_count, 0, ',', '.') }}
                            </td>
                            <td class="px-2 py-3 text-gray-700 text-xs">{{ number_format($data->total_sum, 0, ',', '.') }}
                            </td>
                            <td class="px-2 py-3 text-gray-700 text-xs">{{ number_format($data->npl_sum, 0, ',', '.') }}</td>
                            <td class="px-2 py-2 text-gray-700 text-xs">
                            <a href="{{ route('nominatif.rekap.produk.detail', [
                                    'branch_code' => $branch_code,
                                    'datadate' => implode(',', (array) request()->query('datadate', $datadate)),
                                    'produk' => urlencode($data->KET_KD_PRD),
                                    'recap' => 'nominatif.rekap.produk'
                                ]) }}" class="text-blue-600 underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold text-gray-700 text-xs">
                        <td class="px-2 py-3">TOTAL</td>
                        <td class="px-2 py-3">{{ number_format($sumDeb, 0, ',', '.') }}</td>
                        <td class="px-2 py-3">{{ number_format($sumBaki, 0, ',', '.') }}</td>
                        <td class="px-2 py-3">{{ number_format($sumNPL, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
