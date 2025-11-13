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
        if ($request->is('login') || $request->routeIs('login')) {
            return $next($request);
        }

        if (session('cek') && Auth::check()) {
            return $next($request);
        }

        return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu');
    }
}
