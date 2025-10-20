<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sktms', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('pekerjaan')->nullable();
            $table->string('agama');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->date('tanggal_dibuat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sktms');
    }
};
