<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestLogin extends Command
{
    protected $signature = 'test:login {username} {password}';
    protected $description = 'Test login dengan username dan password';

    public function handle()
    {
        $username = $this->argument('username');
        $password = $this->argument('password');

        $this->info("Testing login untuk: {$username}");

        $admin = Admin::where('username', $username)->first();

        if (!$admin) {
            $this->error("Admin dengan username '{$username}' tidak ditemukan");
            return 1;
        }

        $this->info("✓ Admin ditemukan: {$admin->name}");
        $this->info("  Role: {$admin->role}");
        $this->info("  Password hash (20 chars): " . substr($admin->password, 0, 20) . "...");
        $this->info("  Password length: " . strlen($admin->password));

        // Test password
        $check1 = Hash::check($password, $admin->password);
        $this->info("\nHash::check('{$password}', password): " . ($check1 ? 'TRUE ✓' : 'FALSE ✗'));

        // Test dengan berbagai kemungkinan
        if (!$check1) {
            $this->warn("\nPassword tidak cocok. Mencoba berbagai kemungkinan...");
            
            // Cek apakah password mungkin di-hash dua kali
            $this->info("Mencoba verify dengan asumsi double hash...");
            
            // Coba dengan password yang mungkin
            $possiblePasswords = [$password, $username, 'admin', 'guru'];
            foreach ($possiblePasswords as $pwd) {
                if (Hash::check($pwd, $admin->password)) {
                    $this->info("  ✓ Password sebenarnya adalah: '{$pwd}'");
                }
            }
        }

        return 0;
    }
}

