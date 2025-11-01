<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->dateTime('waktu_pelaksanaan');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('dilihat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
