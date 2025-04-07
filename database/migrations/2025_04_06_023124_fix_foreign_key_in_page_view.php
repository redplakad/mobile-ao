<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeyInPageView extends Migration
{
    public function up(): void
    {
        Schema::table('page_view', function (Blueprint $table) {
            // drop foreign key lama
            $table->dropForeign(['user_id']);

            // tambahkan foreign key baru ke app_users
            $table->foreign('user_id')->references('id')->on('app_users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('page_view', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}