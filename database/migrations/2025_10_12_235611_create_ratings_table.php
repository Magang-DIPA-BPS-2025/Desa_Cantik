<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('belanja_desa_id'); // produk UMKM
            $table->unsignedBigInteger('user_id')->nullable(); // user optional
            $table->tinyInteger('rating')->default(0); // nilai rating 1–5
            $table->text('komentar')->nullable();
            $table->timestamps();

            $table->foreign('belanja_desa_id')
                  ->references('id')
                  ->on('belanja_desas')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
