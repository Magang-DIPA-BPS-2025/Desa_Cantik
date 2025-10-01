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
        if (Schema::hasTable('data_penduduks') && !Schema::hasColumn('data_penduduks', 'dusun')) {
            Schema::table('data_penduduks', function (Blueprint $table) {
                $table->string('dusun', 100)->nullable()->after('alamat');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('data_penduduks') && Schema::hasColumn('data_penduduks', 'dusun')) {
            Schema::table('data_penduduks', function (Blueprint $table) {
                $table->dropColumn('dusun');
            });
        }
    }
};




