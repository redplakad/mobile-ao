<?php

namespace App\Http\Controllers\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RecapByKolExport implements WithMultipleSheets
{
    protected $branchCode;
    protected $datadate;
    protected $branchName;

    public function __construct($branchCode, $datadate, $branchName)
    {
        $this->branchCode = $branchCode;
        $this->datadate = $datadate;
        $this->branchName = $branchName;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Sheet ringkasan utama
        $sheets[] = new RecapSummarySheet($this->branchCode, $this->datadate, $this->branchName);

        // Sheet berdasarkan kode kolek
        $kolekMap = [
            1 => '1. Lancar',
            2 => '2. DPK',
            3 => '3. Kurang Lancar',
            4 => '4. Diragukan',
            5 => '5. Macet',
        ];

        foreach ($kolekMap as $kode => $nama) {
            $sheets[] = new KreditByKolekSheet($this->branchCode, $this->datadate, $kode, $nama);
        }

        return $sheets;
    }
}
