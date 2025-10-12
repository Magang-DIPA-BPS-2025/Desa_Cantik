<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            // nomor_surat nullable until approved
            try {
                $table->string('nomor_surat')->nullable()->change();
            } catch (\Throwable $e) {
                // fallback: add if missing; ignore if change() unsupported without dbal
            }

            // add qr_code if not exists
            if (!Schema::hasColumn('surats', 'qr_code')) {
                $table->string('qr_code')->nullable()->after('keterangan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            if (Schema::hasColumn('surats', 'qr_code')) {
                $table->dropColumn('qr_code');
            }
            // nomor_surat back to not null best-effort
            try {
                $table->string('nomor_surat')->nullable(false)->change();
            } catch (\Throwable $e) {
                // ignore
            }
        });
    }
};



