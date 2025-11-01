<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppid_sub_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('ppid_id');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

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
