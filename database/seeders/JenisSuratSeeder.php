<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'SURAT KETERANGAN USAHA (SKU)',
            'SURAT KETERANGAN TIDAK MAMPU (SKTM)',
            'SURAT KETERANGAN KEMATIAN',
        ];

        foreach ($defaults as $name) {
            JenisSurat::firstOrCreate(['nama_surat' => $name]);
        }
    }
}



