<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('page_view', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('route_name');
            $table->string('url');
            $table->ipAddress('ip_address')->nullable();
            $table->timestamp('viewed_at')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('page_view');
    }
};
