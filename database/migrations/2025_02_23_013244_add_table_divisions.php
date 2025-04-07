<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('division_code')->unique(); // Kode unik divisi
            $table->string('division_name'); // Nama divisi
            $table->foreignId('division_parent')->nullable()->constrained('divisions')->onDelete('set null'); // Relasi ke dirinya sendiri (parent division)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('divisions');
    }
};