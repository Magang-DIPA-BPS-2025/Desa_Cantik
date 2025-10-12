<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            if (!Schema::hasColumn('surats', 'nik')) {
                $table->string('nik', 20)->nullable()->after('penduduk_id');
            }
            if (!Schema::hasColumn('surats', 'nama')) {
                $table->string('nama', 100)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('surats', 'alamat')) {
                $table->string('alamat', 200)->nullable()->after('nama');
            }
            if (!Schema::hasColumn('surats', 'tempat_lahir')) {
                $table->string('tempat_lahir', 100)->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('surats', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
            if (!Schema::hasColumn('surats', 'jenis_kelamin')) {
                $table->string('jenis_kelamin', 20)->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('surats', 'pekerjaan')) {
                $table->string('pekerjaan', 100)->nullable()->after('jenis_kelamin');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            foreach (['nik','nama','alamat','tempat_lahir','tanggal_lahir','jenis_kelamin','pekerjaan'] as $col) {
                if (Schema::hasColumn('surats', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};


