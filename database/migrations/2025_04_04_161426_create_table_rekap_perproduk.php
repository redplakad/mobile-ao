<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rekap_perproduk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('CAB', 10);
            $table->date('datadate');
            $table->integer('KODE_KOLEK');
            $table->integer('KET_KD_PRD');
            $table->integer('total_count');
            $table->decimal('total_sum', 18, 2);
            $table->decimal('total_npl', 18, 2)->nullable();
            $table->decimal('npl_persentase', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekap_perproduk');
    }
};
