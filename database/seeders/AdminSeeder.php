<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akun = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => 'admin', // Biarkan mutator yang hash
                'role' => 'admin',
            ],
            [
                'name' => 'guru',
                'username' => 'guru',
                'password' => 'guru', // Biarkan mutator yang hash
                'role' => 'guru',
            ],

        ];

        foreach ($akun as $key => $v) {
            // Untuk Admin, gunakan password plain karena mutator akan hash otomatis
            Admin::create([
                'name' => $v['name'],
                'username' => $v['username'],
                'password' => $v['password'], // Mutator akan hash otomatis
                'role' => $v['role'],
            ]);

            // Untuk User, gunakan password plain karena User model punya cast 'hashed'
            // yang akan otomatis hash password
            User::create([
                'name' => $v['name'],
                'username' => $v['username'],
                'password' => $v['password'], // Cast 'hashed' akan hash otomatis
                'role' => $v['role'],
            ]);
        }
    }
}
