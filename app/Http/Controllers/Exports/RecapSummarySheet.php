<?php

namespace App\Http\Controllers\Exports;

use App\Models\Kredit;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class RecapSummarySheet implements FromArray, WithHeadings, WithEvents, WithTitle
{
    protected $branchCode;
    protected $datadate;
    protected $branchName;

    protected $totalBaki = 0;
    protected $totalPpap = 0;

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

        $data = Kredit::where('CAB', $this->branchCode)
            ->where('datadate', $this->datadate)
            ->selectRaw('KODE_KOLEK, COUNT(*) as total_deb, SUM(POKOK_PINJAMAN) as total_baki, SUM(CADANGAN_PPAP) as total_ppap')
            ->groupBy('KODE_KOLEK')
            ->get();

        $rows = $data->map(function ($item) use ($kolekMap) {
            $this->totalBaki += $item->total_baki;
            $this->totalPpap += $item->total_ppap;

            return [
                $kolekMap[$item->KODE_KOLEK] ?? $item->KODE_KOLEK,
                number_format($item->total_deb, 0, '', '.'),
                number_format($item->total_baki, 2, ',', '.'),
                number_format($item->total_ppap, 2, ',', '.'),
            ];
        })->toArray();

        $rows[] = [
            'TOTAL',
            '',
            number_format($this->totalBaki, 2, ',', '.'),
            number_format($this->totalPpap, 2, ',', '.'),
        ];

        return $rows;
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

    public function title(): string
    {
        return 'REKAP KOLEK';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->mergeCells('A1:D1');
                $sheet->mergeCells('A2:D2');
                $sheet->mergeCells('A3:D3');

                $sheet->getStyle('A1:D3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->getStyle('A4:D4')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                ]);

                $lastRow = $sheet->getHighestRow();

                $sheet->getStyle("A5:D{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                ]);

                // Lebar kolom
                $sheet->getColumnDimension('A')->setWidth(25);
                $sheet->getColumnDimension('B')->setWidth(14);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(18);
            }
        ];
    }
}
