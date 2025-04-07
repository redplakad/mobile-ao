<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('nominatif_kredit', function (Blueprint $table) {
            $table->id();
            $table->date('datadate')->nullable();
            $table->string('CAB', 3)->nullable();
            $table->string('NOREK', 12)->nullable();
            $table->string('NO_CIF', 10)->nullable();
            $table->string('NAMA_NASABAH', 150)->nullable();
            $table->string('ALAMAT', 150)->nullable();
            $table->integer('KODE_KOLEK')->nullable();
            $table->integer('JML_HARI_TUNGGAKAN')->nullable();
            $table->string('KD_PRD', 3)->nullable();
            $table->string('KET_KD_PRD', 50)->nullable();
            $table->string('NOMOR_PERJANJIAN', 50)->nullable();
            $table->string('TGL_PK', 8)->nullable();
            $table->string('TGL_AWAL_FAS', 8)->nullable();
            $table->string('TGL_AKHIR_FAS', 8)->nullable();
            $table->double('PLAFOND_AWAL', 12, 2)->nullable();
            $table->float('PERSEN_BGA', 5, 2)->nullable();
            $table->double('TUNGGAKAN_POKOK', 12, 2)->nullable();
            $table->double('TUNGGAKAN_BUNGA', 12, 2)->nullable();
            $table->double('ANGSURAN_TOTAL', 12, 2)->nullable();
            $table->string('NO_HP', 20)->nullable();
            $table->double('POKOK_PINJAMAN', 12, 2)->nullable();
            $table->double('TITIPAN_EFEKTIF', 12, 2)->nullable();
            $table->integer('JANGKA_WAKTU')->nullable();
            $table->string('REK_PENCAIRAN', 12)->nullable();
            $table->string('TGL_LAHIR', 8)->nullable();
            $table->string('NIK', 50)->nullable();
            $table->string('AO', 50)->nullable();
            $table->string('KELURAHAN', 50)->nullable();
            $table->string('KECAMATAN', 50)->nullable();
            $table->double('CADANGAN_PPAP', 12, 2)->nullable();
            $table->string('TEMPAT_BEKERJA', 100)->nullable();
            $table->string('TGL_AKHIR_BAYAR', 8)->nullable();
            $table->string('JENIS_JAMINAN', 8)->nullable();
            $table->double('NILAI_LEGALITAS', 12, 2)->nullable();
            $table->string('RESTRUKTUR_KE', 2)->nullable();
            $table->string('TGL_VALID_KOLEK', 8)->nullable();
            $table->string('TGL_MACET', 8)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominatif');
    }
};
