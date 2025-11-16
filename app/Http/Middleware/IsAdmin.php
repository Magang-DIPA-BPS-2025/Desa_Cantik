<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek session terlebih dahulu
        if (!session('cek')) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu');
        }

        // Cek role dari session
        $role = session('role');
        if ($role !== 'admin') {
            abort(403, 'Unauthorized - Hanya admin yang dapat mengakses halaman ini');
        }

        return $next($request);
    }
}
