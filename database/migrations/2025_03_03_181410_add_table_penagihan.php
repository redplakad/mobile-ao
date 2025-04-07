<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('penagihan', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->decimal('lat', 10, 7);
                $table->decimal('lng', 10, 7);
                $table->string('nomor_kredit');
                $table->string('nama_debitur');
                $table->string('no_telepon');
                $table->text('address');
                $table->string('hasil_kunjungan');
                $table->date('janji_bayar')->nullable();
                $table->text('uraian_kunjungan');
                $table->longText('image')->nullable();
                $table->longText('image1')->nullable();
                $table->longText('image2')->nullable();
                $table->longText('image3')->nullable();
                $table->unsignedBigInteger('by_user');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('by_user')->references('id')->on('app_users')->onDelete('cascade');
            });
        }

        public function down()
        {
            Schema::dropIfExists('penagihan');
        }
    };
