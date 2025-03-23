<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    protected $table = 'nominatif_kredit';

    protected $fillable = [
        'datadate',
        'CAB',
        'NOREK',
        'NO_CIF',
        'NAMA_NASABAH',
        'ALAMAT',
        'KODE_KOLEK',
        'JML_HARI_TUNGGAKAN',
        'KD_PRD',
        'KET_KD_PRD',
        'NOMOR_PERJANJIAN',
        'TGL_PK',
        'TGL_AWAL_FAS',
        'TGL_AKHIR_FAS',
        'PLAFOND_AWAL',
        'PERSEN_BGA',
        'TUNGGAKAN_POKOK',
        'TUNGGAKAN_BUNGA',
        'ANGSURAN_TOTAL',
        'NO_HP',
        'POKOK_PINJAMAN',
        'TITIPAN_EFEKTIF',
        'JANGKA_WAKTU',
        'REK_PENCAIRAN',
        'TGL_LAHIR',
        'NIK',
        'AO',
        'KELURAHAN',
        'KECAMATAN',
        'CADANGAN_PPAP',
        'TEMPAT_BEKERJA',
        'TGL_AKHIR_BAYAR',
        'JENIS_JAMINAN',
        'NILAI_LEGALITAS',
        'RESTRUKTUR_KE',
        'TGL_VALID_KOLEK',
        'TGL_MACET',
    ];


    protected $casts = [
        'datadate' => 'date',
        'KODE_KOLEK' => 'integer',
        'JML_HARI_TUNGGAKAN' => 'integer',
        'PLAFOND_AWAL' => 'double',
        'PERSEN_BGA' => 'float',
        'TUNGGAKAN_POKOK' => 'double',
        'TUNGGAKAN_BUNGA' => 'double',
        'ANGSURAN_TOTAL' => 'double',
        'POKOK_PINJAMAN' => 'double',
        'TITIPAN_EFEKTIF' => 'double',
        'JANGKA_WAKTU' => 'integer',
        'CADANGAN_PPAP' => 'double',
        'NILAI_LEGALITAS' => 'double',
    ];
}
