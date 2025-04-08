<?php

namespace App\Http\Controllers\Exports;

use App\Models\RekapPerkol;
use App\Models\Kredit;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RecapByKolExport implements FromArray, WithHeadings, WithEvents
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

    public function array(): array
    {
        $kolekMap = [
            1 => '1. Lancar',
            2 => '2. DPK',
            3 => '3. Kurang Lancar',
            4 => '4. Diragukan',
            5 => '5. Macet',
        ];

        return RekapPerkol::where('CAB', $this->branchCode)
            ->where('datadate', $this->datadate)
            ->get()
            ->map(function ($item) use ($kolekMap) {
                $cadangan = Kredit::where('CAB', $this->branchCode)
                    ->where('KODE_KOLEK', $item->KODE_KOLEK)
                    ->where('datadate', $this->datadate)
                    ->sum('cadangan_ppap');

                return [
                    $kolekMap[$item->KODE_KOLEK] ?? $item->KODE_KOLEK,
                    number_format($item->total_count, 0, '', ','),
                    number_format($item->total_sum, 2, '.', ','),
                    number_format($cadangan, 2, '.', ','),
                ];
            })
            ->toArray();
    }

    public function headings(): array
    {
        return [
            ["PT BPR SERANG {$this->branchName}"],
            ['REKAP DATA KREDIT PER KOLEKTIBILITAS'],
            ["Data per {$this->datadate}"],
            ['Kode Kolek', 'Total Debitur', 'Total Baki Debet', 'Cadangan PPAP'],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->mergeCells('A3:D3');

                $event->sheet->getStyle('A1:D3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                $event->sheet->getStyle('A4:D4')->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                $lastRow = $event->sheet->getDelegate()->getHighestRow();
                $event->sheet->getStyle("A4:D{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                ]);
            }
        ];
    }
}
