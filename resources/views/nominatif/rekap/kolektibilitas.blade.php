@extends('layouts.second')

@section('title', 'Daftar Penagihan')
@section('content')
    @php
        $kolekLabels = [
            1 => '1 Lancar',
            2 => '2 DPK',
            3 => '3 Kurang Lancar',
            4 => '4 Diragukan',
            5 => '5 Macet',
        ];
    @endphp
    <div id="Top-nav" class="relative flex items-center justify-between px-4 pt-10">
        <!-- Back Button -->
        <a href="{{ route('nominatif.index') }}">
            <div class="w-10 h-10 flex shrink-0 items-center">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>

        <!-- Title Centered -->
        <div class="absolute left-1/2 top-10 transform -translate-x-1/2 text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Rekap Kolektibilitas</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]"></p>
        </div>
    </div>
    <div class="w-full mx-auto px-4 py-8">

        {{-- Card Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-semibold text-blue-800">Debitur</h3>
                <p class="text-2xl font-bold text-blue-900">{{ $recapData->sum('total_count') }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-semibold text-green-800">Bakidebet</h3>
                <p class="text-2xl font-bold text-green-900">Rp
                    {{ number_format($recapData->sum('total_sum'), 0, ',', '.') }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-semibold text-yellow-800">Total NPL</h3>
                <p class="text-2xl font-bold text-yellow-900">{{ number_format($sumNPL, 0, ',', '.') }}</p>
            </div>
            <div class="bg-orange-100 p-4 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-semibold text-orange-800">NPL</h3>
                <p class="text-2xl font-bold text-orange-900">{{ number_format(($sumNPL/$sumBaki)*100, 2, ',', '.') }}%</p>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-xs">
                        <th class="px-2 py-3">Kolektibilitas</th>
                        <th class="px-2 py-3">Deb</th>
                        <th class="px-2 py-3">Bakidebet</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($recapData as $data)
                        @php
                            $sumBaki += $data->total_sum;
                            $sumDeb += $data->total_count;
                            if ($data->KODE_KOLEK > 2) {
                                $sumNPL += $data->total_sum;
                            }
                        @endphp
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="px-2 py-3 text-xs">{{ $kolekLabels[$data->KODE_KOLEK] ?? 'Unknown' }}</td>
                            <td class="px-2 py-3 text-gray-700 text-xs">{{ number_format($data->total_count, 0, ',', '.') }}
                            </td>
                            <td class="px-2 py-3 text-gray-700 text-xs">{{ number_format($data->total_sum, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold text-gray-700 text-xs">
                        <td class="px-2 py-3">TOTAL</td>
                        <td class="px-2 py-3">{{ number_format($sumDeb, 0, ',', '.') }}</td>
                        <td class="px-2 py-3">{{ number_format($sumBaki, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="font-semibold text-gray-700 text-xs">
                        <td class="px-2 py-3" colspan="2">TOTAL NPL</td>
                        <td class="px-2 py-3">{{ number_format($sumNPL, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
