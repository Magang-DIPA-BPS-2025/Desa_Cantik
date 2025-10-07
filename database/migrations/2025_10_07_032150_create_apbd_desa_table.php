<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apbd_desa', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');

            // Total fields
            $table->decimal('total_pendapatan', 15, 2)->default(0);
            $table->decimal('total_belanja', 15, 2)->default(0);
            $table->decimal('penerimaan', 15, 2)->default(0);
            $table->decimal('pengeluaran', 15, 2)->default(0);
            $table->decimal('surplus_defisit', 15, 2)->default(0);

            // Pendapatan fields
            $table->decimal('pendapatan_pad', 15, 2)->default(0);
            $table->decimal('pendapatan_pad_persen', 5, 2)->default(0);
            $table->decimal('pendapatan_transfer', 15, 2)->default(0);
            $table->decimal('pendapatan_transfer_persen', 5, 2)->default(0);
            $table->decimal('pendapatan_lain', 15, 2)->default(0);
            $table->decimal('pendapatan_lain_persen', 5, 2)->default(0);

            // Belanja fields
            $table->decimal('belanja_pemerintahan', 15, 2)->default(0);
            $table->decimal('belanja_pemerintahan_persen', 5, 2)->default(0);
            $table->decimal('belanja_pembangunan', 15, 2)->default(0);
            $table->decimal('belanja_pembangunan_persen', 5, 2)->default(0);
            $table->decimal('belanja_pembinaan', 15, 2)->default(0);
            $table->decimal('belanja_pembinaan_persen', 5, 2)->default(0);
            $table->decimal('belanja_pemberdayaan', 15, 2)->default(0);
            $table->decimal('belanja_pemberdayaan_persen', 5, 2)->default(0);
            $table->decimal('belanja_bencana', 15, 2)->default(0);
            $table->decimal('belanja_bencana_persen', 5, 2)->default(0);

            // Pembiayaan fields
            $table->decimal('pembiayaan_penerimaan', 15, 2)->default(0);
            $table->decimal('pembiayaan_penerimaan_persen', 5, 2)->default(0);
            $table->decimal('pembiayaan_pengeluaran', 15, 2)->default(0);
            $table->decimal('pembiayaan_pengeluaran_persen', 5, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbd_desa');
    }
};
