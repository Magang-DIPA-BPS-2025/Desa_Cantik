<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sktms', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['Belum Diverifikasi', 'Terverifikasi'])->default('Belum Diverifikasi')->after('email');
            $table->string('nomor_surat')->nullable()->after('status_verifikasi');
        });
    }

    public function down()
    {
        Schema::table('sktms', function (Blueprint $table) {
            $table->dropColumn(['status_verifikasi', 'nomor_surat']);
        });
    }
};