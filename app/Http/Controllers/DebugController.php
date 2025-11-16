<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DebugController extends Controller
{
    public function testLogin(Request $request)
    {
        $username = $request->get('username', 'admin');
        $password = $request->get('password', 'admin');
        
        $admin = Admin::where('username', $username)->first();
        
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin tidak ditemukan',
                'username' => $username
            ]);
        }
        
        $passwordCheck = Hash::check($password, $admin->password);
        $sessionCheck = session('cek');
        
        return response()->json([
            'status' => 'success',
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'username' => $admin->username,
                'role' => $admin->role,
                'password_hash_preview' => substr($admin->password, 0, 20) . '...',
                'password_length' => strlen($admin->password),
            ],
            'password_check' => [
                'input_password' => $password,
                'matches' => $passwordCheck,
                'hash_check_result' => $passwordCheck ? 'TRUE' : 'FALSE'
            ],
            'session' => [
                'cek' => $sessionCheck,
                'user_id' => session('user_id'),
                'username' => session('username'),
                'role' => session('role'),
            ]
        ]);
    }
}

