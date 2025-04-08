<?php

namespace App\Http\Controllers\Exports;

use Illuminate\Support\Collection;
use App\Models\Kredit;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecapByProdukExport implements FromCollection, WithHeadings
{
    protected $branchCode;
    protected $datadate;

    public function __construct($branchCode, $datadate)
    {
        $this->branchCode = $branchCode;
        $this->datadate = $datadate;
    }

    public function collection()
    {
        $cacheKey = "recap_by_produk_{$this->branchCode}_{$this->datadate}";

        return Cache::remember($cacheKey, now()->addHours(2), function () {
            return Kredit::select('KET_KD_PRD')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where('datadate', $this->datadate)
                ->where('CAB', $this->branchCode)
                ->groupBy('KET_KD_PRD')
                ->orderByDesc('total_sum')
                ->get();
        });
    }

    public function headings(): array
    {
        return ['Produk', 'Total Debitur', 'Total Baki Debet', 'Total NPL'];
    }
}
