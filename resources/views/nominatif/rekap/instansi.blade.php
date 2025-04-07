@extends('layouts.second')
@section('content')
    <div id="Top-nav" class="relative flex items-center justify-between px-4 pt-10">
        <a href="{{ route('nominatif.index') }}">
            <div class="w-10 h-10 flex shrink-0 items-center">
                <x-tabler-arrow-narrow-left />
            </div>
        </a>
        <div class="absolute left-1/2 top-10 transform -translate-x-1/2 text-center">
            <h1 class="font-semibold text-lg leading-[27px]">Rekap Instansi</h1>
            <p class="text-sm leading-[21px] text-[#909DBF]"></p>
        </div>
    </div>
    <div class="w-full mx-auto px-4 py-8">
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

        <div class="bg-white rounded-lg overflow-hidden px-4 py-4 text-xs">
            <table id="instansi-table" class="min-w-full text-left text-gray-700 bg-white">
                <thead class="bg-white">
                    <tr class="bg-white">
                        <th class="px-2 py-2">Instansi</th>
                        <th class="px-2 py-2">Deb</th>
                        <th class="px-2 py-2">Bakidebet</th>
                        <th class="px-2 py-2">NPL</th>
                        <th class="px-2 py-2">#</th>
                    </tr>
                </thead>
                <tbody class="bg-white"></tbody>
            </table>
        </div>

    </div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
<style>
    div.dataTables_wrapper {
        font-size: 0.75rem; /* text-xs */
        background-color: white !important;
    }
    div.dataTables_wrapper select,
    div.dataTables_wrapper input{
        background: white !important;
        padding: 2px 5px !important;
        font-size: 12px !important;
        border: 1px solid #ddd;
        border-radius: 6px;
    }
    div.dataTables_wrapper .my-2{
        border:0 solid #fff !important;
    }


    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 1rem;
        background-color: white !important;
    }
    div.dataTables_wrapper .dataTables_info {
        margin-top: 10px !important;
        margin-bottom: 10px !important;
        margin-left:12px !important;
    }

    table.dataTable.no-footer,
    table.dataTable thead th,
    table.dataTable tbody td,
    table.dataTable,
    table,
    tr,
    td,
    th {
        border: none !important;
        background-color: white !important;
        font-size: 12px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: white !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.75rem !important;
        margin: 0 2px !important;
        border-radius: 0.25rem !important;
        border: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #1f2937 !important;
        color: white !important;
    }

    #instansi-table_paginate a{
        background-color: white !important;
        color: #888 !important;
        padding: 3px 16px !important;
    }
</style>
@endpush

@push('javascript')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

<script>
        $(document).ready(function () {
            $('#instansi-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("nominatif.rekap.instansi.data", ["branch_code" => $branch_code, "datadate" => $datadate]) }}',
                columns: [
                    {
                        data: 'TEMPAT_BEKERJA',
                        render: function (data, type, row) {
                            return `<a href="${row.TEMPAT_BEKERJA_LINK}" class="text-blue-600 underline">${data ?? 'Unknown'}</a>`;
                        }
                    },
                    {
                        data: 'total_count',
                        render: data => parseInt(data).toLocaleString('id-ID')
                    },
                    {
                        data: 'total_sum',
                        render: data => parseInt(data).toLocaleString('id-ID')
                    },
                    {
                        data: 'npl_sum',
                        render: data => parseInt(data).toLocaleString('id-ID')
                    },
                    {
                        data: 'DETAIL_LINK',
                        render: function (data) {
                            return `<a href="${data}" class="text-blue-600 underline">Detail</a>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
