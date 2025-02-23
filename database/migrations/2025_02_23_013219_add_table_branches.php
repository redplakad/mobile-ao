<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code')->unique(); // Kode unik cabang
            $table->string('branch_name'); // Nama cabang
            $table->text('branch_address')->nullable(); // Alamat cabang
            $table->string('branch_phone')->nullable(); // Nomor telepon cabang
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
};