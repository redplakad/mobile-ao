<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NominatifImportController extends Controller
{
    public function form()
    {
        return view('nominatif.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
            'datadate' => 'required|date',
        ]);

        $file = $request->file('csv_file');
        $datadate = $request->datadate;

        $headerMap = [
            'CAB' => 'CAB',
            'NOREK' => 'NOREK',
            'NO_CIF' => 'NO_CIF',
            'NAMA_NASABAH' => 'NAMA_NASABAH',
            'ALAMAT' => 'ALAMAT',
            'KODE_KOLEK' => 'KODE_KOLEK',
            'JML_HARI_TUNGGAKAN' => 'JML_HARI_TUNGGAKAN',
            'KD_PRD' => 'KD_PRD',
            'KET_KD_PRD' => 'KET_KD_PRD',
            'NOMOR_PERJANJIAN' => 'NOMOR_PERJANJIAN',
            'TGL_PK' => 'TGL_PK',
            'TGL_AWAL_FAS' => 'TGL_AWAL_FAS',
            'TGL_AKHIR_FAS' => 'TGL_AKHIR_FAS',
            'PLAFOND_AWAL' => 'PLAFOND_AWAL',
            '%BGA' => 'PERSEN_BGA', // Mapping khusus
            'TUNGGAKAN_POKOK' => 'TUNGGAKAN_POKOK',
            'TUNGGAKAN_BUNGA' => 'TUNGGAKAN_BUNGA',
            'ANGSURAN_TOTAL' => 'ANGSURAN_TOTAL',
            'NO_HP' => 'NO_HP',
            'POKOK_PINJAMAN' => 'POKOK_PINJAMAN',
            'TITIPAN_EFEKTIF' => 'TITIPAN_EFEKTIF',
            'JANGKA_WAKTU' => 'JANGKA_WAKTU',
            'REK_PENCAIRAN' => 'REK_PENCAIRAN',
            'TGL_LAHIR' => 'TGL_LAHIR',
            'NIK' => 'NIK',
            'AO' => 'AO',
            'KELURAHAN' => 'KELURAHAN',
            'KECAMATAN' => 'KECAMATAN',
            'CADANGAN_PPAP' => 'CADANGAN_PPAP',
            'TEMPAT_BEKERJA' => 'TEMPAT_BEKERJA',
            'TGL_AKHIR_BAYAR' => 'TGL_AKHIR_BAYAR',
            'JENIS_JAMINAN' => 'JENIS_JAMINAN',
            'NILAI_LEGALITAS' => 'NILAI_LEGALITAS',
            'RESTRUKTUR_KE' => 'RESTRUKTUR_KE',
            'TGL_VALID_KOLEK' => 'TGL_VALID_KOLEK',
            'TGL_MACET' => 'TGL_MACET',
        ];

        $data = array_map('str_getcsv', file($file));
        $headers = array_map('trim', $data[0]);

        unset($data[0]); // remove header row

        foreach ($data as $row) {
            $rowData = [];
            foreach ($headers as $index => $headerName) {
                $dbColumn = $headerMap[$headerName] ?? null;
                if ($dbColumn) {
                    $rowData[$dbColumn] = $row[$index] ?? null;
                }
            }
            $rowData['datadate'] = $datadate;

            Kredit::create($rowData);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }
}
