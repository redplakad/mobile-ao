<?php

namespace App\Http\Controllers\Exports;

use App\Models\Kredit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KreditByKolekSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $branchCode;
    protected $datadate;
    protected $kodeKolek;
    protected $title;

    public function __construct($branchCode, $datadate, $kodeKolek, $title)
    {
        $this->branchCode = $branchCode;
        $this->datadate = $datadate;
        $this->kodeKolek = $kodeKolek;
        $this->title = $title;
    }

    public function collection()
    {
        return Kredit::where('CAB', $this->branchCode)
            ->where('datadate', $this->datadate)
            ->where('KODE_KOLEK', $this->kodeKolek)
            ->get();
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return (new Kredit)->getFillable();
    }
}
