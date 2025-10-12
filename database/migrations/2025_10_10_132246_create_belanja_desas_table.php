<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('belanja_desas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('foto')->nullable();
            $table->decimal('harga', 15, 2)->default(0); // harga maksimal 999.999.999.999,99
            $table->decimal('rating', 2, 1)->default(0); // rating 0.0 - 5.0
            $table->string('wa')->nullable(); // nomor WhatsApp opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanja_desas');
    }
};
