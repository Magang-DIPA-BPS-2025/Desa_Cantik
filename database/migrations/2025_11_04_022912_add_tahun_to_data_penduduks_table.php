<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('data_penduduks', function (Blueprint $table) {
        $table->year('tahun')->after('jenis_kelamin');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('data_penduduks', function (Blueprint $table) {
        $table->dropColumn('tahun');
    });
}

};
