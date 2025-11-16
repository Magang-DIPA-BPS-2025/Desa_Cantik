<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('pages.auth.login', ['menu' => 'login']);
    }

    public function login_action(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'nullable|string',
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // Set default role - ambil dari request atau set default 'admin'
        $role = $request->role ?? 'admin';
        
        // Jika role masih kosong dan username adalah 'admin', set ke 'admin'
        if (empty($role) && $request->username == 'admin') {
            $role = 'admin';
        }

        // Pastikan role tidak kosong
        if (empty($role)) {
            $role = 'admin'; // Default ke admin
        }

        // Cari user di Admin model terlebih dahulu
        $user = Admin::where('username', $request->username)
            ->where('role', $role)
            ->first();

        // Jika tidak ditemukan di Admin, coba tanpa filter role dulu
        if (!$user) {
            $user = Admin::where('username', $request->username)->first();
            if ($user) {
                // Jika ditemukan dengan role berbeda, update role dari request
                $role = $user->role;
            }
        }

        // Jika masih tidak ditemukan di Admin, cari di User model
        if (!$user) {
            $user = User::where('username', $request->username)
                ->where('role', $role)
                ->first();
        }

        // Cek apakah user ditemukan
        if (!$user) {
            \Log::warning('Login failed - User not found', [
                'username' => $request->username,
                'role' => $role
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['username' => 'Username atau role tidak ditemukan'])
                ->with('message', 'gagal login');
        }

        // Verifikasi password
        $passwordMatch = \Hash::check($request->password, $user->password);

        if (!$passwordMatch) {
            \Log::warning('Login failed - Password mismatch', [
                'username' => $request->username,
                'role' => $role,
                'user_id' => $user->id,
                'password_hash_preview' => substr($user->password, 0, 20) . '...'
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['password' => 'Password salah. Pastikan username dan password benar.'])
                ->with('message', 'gagal login');
        }

        // Set session - PASTIKAN semua session di-set
        Session::put('user_id', $user->id);
        Session::put('name', $user->name);
        Session::put('username', $user->username);
        Session::put('role', $user->role);
        Session::put('cek', true);

        // Simpan session
        Session::save();

        // Login menggunakan Auth untuk middleware (opsional, karena kita pakai session)
        try {
            if ($user instanceof Admin) {
                Auth::guard('admin')->login($user);
            } else {
                Auth::login($user);
            }
        } catch (\Exception $e) {
            // Jika Auth login gagal, tetap lanjutkan dengan session saja
            \Log::warning('Auth login failed, using session only', ['error' => $e->getMessage()]);
        }

        \Log::info('Login successful', [
            'username' => $user->username,
            'role' => $user->role,
            'user_id' => $user->id
        ]);

        return redirect()->route('dashboard')->with('message', 'sukses login');
    }

}
