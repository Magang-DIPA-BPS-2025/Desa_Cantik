<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('nama', 255);
            $table->text('alamat');
            $table->string('pekerjaan', 255)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('hari', 50);
            $table->date('tanggal');
            $table->string('tempat', 255);
            $table->string('jenis_acara', 255);
            $table->date('tanggal_dibuat');
            $table->enum('status_verifikasi', ['Belum Diverifikasi', 'Terverifikasi'])->default('Belum Diverifikasi');
            $table->string('nomor_surat', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('izins');
    }
};