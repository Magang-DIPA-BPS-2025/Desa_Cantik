<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixAdminPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:fix-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaiki password admin yang mungkin sudah di-hash dua kali';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memperbaiki password admin...');
        $this->warn('Ini akan mereset password untuk akun admin dan guru ke default!');

        if (!$this->confirm('Lanjutkan?', true)) {
            $this->info('Dibatalkan.');
            return 0;
        }

        $admins = Admin::all();
        $fixed = 0;

        foreach ($admins as $admin) {
            // Reset password untuk admin dan guru ke default
            if (in_array($admin->username, ['admin', 'guru'])) {
                $defaultPassword = $admin->username;
                
                // Update password langsung ke database dengan hash yang benar (sekali hash saja)
                // Kita bypass mutator dengan update langsung ke DB
                DB::table('admins')
                    ->where('id', $admin->id)
                    ->update([
                        'password' => bcrypt($defaultPassword), // Hash sekali dengan bcrypt
                        'updated_at' => now()
                    ]);
                
                $fixed++;
                $this->info("✓ Password untuk '{$admin->username}' telah direset ke '{$defaultPassword}'");
            }
        }

        if ($fixed > 0) {
            $this->info("\n✓ Total {$fixed} password telah diperbaiki");
            $this->info("\nPassword default:");
            $this->info("  - Username: admin, Password: admin");
            $this->info("  - Username: guru, Password: guru");
            $this->info("\nSilakan login dengan password default di atas.");
        } else {
            $this->info("\n✓ Tidak ada akun admin/guru yang ditemukan");
        }

        return 0;
    }
}
