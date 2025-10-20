<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('pekerjaan')->nullable();
            $table->string('nama_usaha');
            $table->string('alamat_usaha');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->date('tanggal_dibuat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
