<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('judul');
            $table->text('deskripsi_singkat');
            $table->integer('dilihat')->default(0);
            $table->date('tanggal_event')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_desa');
    }
};
