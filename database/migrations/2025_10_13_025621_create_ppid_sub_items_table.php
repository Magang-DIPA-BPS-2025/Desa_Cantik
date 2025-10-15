<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppid_sub_items', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // pastikan sama dengan tabel referensi

            $table->id();
            $table->unsignedBigInteger('ppid_id'); // tipe sama dengan ppids.id
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file')->nullable(); // file upload (pdf/jpg/png/doc)
            $table->timestamps();

            // foreign key manual (lebih aman di MariaDB)
            $table->foreign('ppid_id')
                  ->references('id')
                  ->on('ppids')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppid_sub_items');
    }
};
