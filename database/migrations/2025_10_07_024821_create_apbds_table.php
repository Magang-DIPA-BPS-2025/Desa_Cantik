<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apbds', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->enum('jenis', ['pendapatan', 'belanja', 'pembiayaan']);
            $table->string('uraian');
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->decimal('realisasi', 15, 2)->default(0);
            $table->decimal('persentase', 5, 2)->nullable(); // opsional, bisa auto dihitung lewat accessor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apbds');
    }
};
