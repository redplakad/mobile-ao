<?php

namespace App\Http\Controllers;

use App\Jobs\ImportKreditJob;
use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


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
            '%BGA' => 'PERSEN_BGA',
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
        
        $userId = Auth::id();

        // Buka file CSV dan parse baris dengan delimiter '|'
        $rows = [];
        if (($handle = fopen($file, 'r')) !== false) {
            // Baca header
            $headers = fgetcsv($handle, 0, '|');
            $headers = array_map('trim', $headers); // Buang spasi tambahan dari header
    
            while (($row = fgetcsv($handle, 0, '|')) !== false) {
                $rowAssoc = array_combine($headers, $row);
                $rows[] = $rowAssoc;
    
                // Potong setiap 1000 baris agar tidak overload
                if (count($rows) === 1000) {
                    ImportKreditJob::dispatch($rows, $datadate, $headerMap, $userId);
                    $rows = [];
                }
            }
            fclose($handle);
        }
    
        // Jika ada sisa baris yang belum di-dispatch
        if (!empty($rows)) {
            ImportKreditJob::dispatch($rows, $datadate, $headerMap, $userId);
        }
    
        return redirect()->back()->with('success', 'Proses import telah dimulai, akan selesai dalam beberapa saat.');
    }
}
