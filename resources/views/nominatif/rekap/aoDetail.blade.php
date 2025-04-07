@extends('layouts.second')
@section('content')
    @php
        $kolekLabels = [
            1 => '1 - Lancar',
            2 => '2 - DPK',
            3 => '3 - Kurang Lancar',
            4 => '4 - Diragukan',
            5 => '5 - Macet',
        ];
        $ao = urldecode(request('ao'));
        $items = $recapData[$ao] ?? collect();
        $totalDeb = $items->sum('total_count');
        $totalBaki = $items->sum('total_sum');
        $totalNPL = $items->sum('npl_sum');

        $url = route('nominatif.rekap.ao', ['branch_code' => $branch_code, 'datadate' => $datadate, 'ao' => request('ao'), 'kolektibilitas' => request('kolektibilitas')]);
    @endphp

    <div id="Top-nav" class="relative flex items-center justify-between px-4 pt-10">
        <a href="{{ $url }}">
            <div class="w-10 h-10 flex shrink-0 items-center">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="absolute left-1/2 top-10 transform -translate-x-1/2 text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Rekap {{ $ao }}</h1>
        </div>
    </div>

    <div class="w-full mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div class="bg-blue-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Debitur</h3>
                <p class="text-sm font-extrabold">{{ number_format($totalDeb, 0, ',', '.') }}</p>
            </div>
            <div class="bg-green-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Bakidebet</h3>
                <p class="text-sm font-extrabold">Rp {{ number_format($totalBaki, 0, ',', '.') }}</p>
            </div>
            <div class="bg-yellow-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">Total NPL</h3>
                <p class="text-sm font-extrabold">{{ number_format($totalNPL, 0, ',', '.') }}</p>
            </div>
            <div class="bg-red-500 p-6 rounded-lg shadow-md text-center text-white">
                <h3 class="text-xs font-semibold">NPL</h3>
                <p class="text-sm font-extrabold">
                    {{ $totalBaki != 0 ? number_format(($totalNPL / $totalBaki) * 100, 2, ',', '.') : '0,00' }}%
                </p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="font-bold text-md mb-2">{{ $ao }}</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white text-left text-xs">
                            <th class="px-2 py-3">Kolek</th>
                            <th class="px-2 py-3">Deb</th>
                            <th class="px-2 py-3">Bakidebet</th>
                            <th class="px-2 py-3">Presentase</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($items as $data)
                            <tr class="hover:bg-gray-100 transition duration-300 text-xs text-gray-700">
                                <td class="px-2 py-3">
                                    <a href="{{ route('nominatif.cabang', [
                                        'branch_code' => $branch_code, 
                                        'datadate' => implode(',', (array) request()->query('datadate', $datadate)),
                                        'ao' => urlencode($data->AO),
                                        'kolektibilitas' => $data->KODE_KOLEK,
                                        'recap' => 'nominatif.rekap.ao.detail'
                                    ]) }}">
                                        {{ $kolekLabels[$data->KODE_KOLEK] ?? $data->KODE_KOLEK }}
                                    </a>
                                </td>
                                <td class="px-2 py-3">{{ number_format($data->total_count, 0, ',', '.') }}</td>
                                <td class="px-2 py-3">{{ number_format($data->total_sum, 0, ',', '.') }}</td>
                                <td class="px-2 py-3">{{ number_format(($data->total_sum / $totalBaki)*100, 2, ',', '.') }}%</td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-200 font-semibold text-xs text-gray-800">
                            <td class="px-2 py-3">Total</td>
                            <td class="px-2 py-3">{{ number_format($totalDeb, 0, ',', '.') }}</td>
                            <td class="px-2 py-3">{{ number_format($totalBaki, 0, ',', '.') }}</td>
                            <td class="px-2 py-3">{{ number_format($totalNPL, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
