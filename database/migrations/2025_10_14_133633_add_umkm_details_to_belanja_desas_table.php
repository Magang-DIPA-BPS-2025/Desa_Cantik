<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('belanja_desas', function (Blueprint $table) {
            // Tambahkan field-field baru
            $table->string('kategori')->nullable()->after('judul');
            $table->text('deskripsi')->nullable()->after('kategori');
            $table->string('lokasi')->nullable()->after('deskripsi');
            $table->string('pemilik')->nullable()->after('lokasi');
            $table->decimal('latitude', 10, 8)->nullable()->after('pemilik');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->text('alamat_lengkap')->nullable()->after('longitude');
            $table->time('jam_buka')->nullable()->after('alamat_lengkap');
            $table->time('jam_tutup')->nullable()->after('jam_buka');
            
    
        });
    }

    public function down(): void
    {
        Schema::table('belanja_desas', function (Blueprint $table) {
            $table->dropColumn([
                'kategori',
                'deskripsi',
                'lokasi',
                'pemilik',
                'latitude',
                'longitude',
                'alamat_lengkap',
                'jam_buka',
                'jam_tutup'
            ]);
        });
    }
};