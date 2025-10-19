<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('asal');
            $table->string('nomor_hp')->nullable();
            $table->text('keperluan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku_tamus');
    }
};