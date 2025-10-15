<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permohonan_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('asal_instansi')->nullable();
            $table->string('alamat_email');
            $table->text('permohonan');
            $table->string('file_path')->nullable(); // file lampiran
            $table->enum('status', ['diproses', 'selesai', 'ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasi');
    }
};
