<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppids', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // pastikan engine mendukung foreign key
            $table->id(); // otomatis unsignedBigInteger + autoIncrement
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('file')->nullable(); // file upload (pdf/jpg/png/doc)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppids');
    }
};
