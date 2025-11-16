<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidasiUser
{
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan akses ke halaman login
        if ($request->is('auth*') || $request->routeIs('login') || $request->routeIs('login_action')) {
            return $next($request);
        }

        // Cek session - ini yang utama karena sistem menggunakan session-based auth
        if (session('cek') && session('user_id')) {
            return $next($request);
        }

        // Cek Auth sebagai fallback (opsional)
        if (Auth::check() || Auth::guard('admin')->check()) {
            // Jika Auth check berhasil tapi session belum di-set, set session
            $user = Auth::user() ?? Auth::guard('admin')->user();
            if ($user) {
                session([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username ?? $user->email,
                    'role' => $user->role ?? 'admin',
                    'cek' => true
                ]);
                return $next($request);
            }
        }

        return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu');
    }
}
