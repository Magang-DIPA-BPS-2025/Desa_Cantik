<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skematians', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_kk')->nullable();
            $table->date('tanggal_kematian');
            $table->date('tanggal_dibuat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skematians');
    }
};
