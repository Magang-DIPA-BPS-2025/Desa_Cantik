<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\DataPenduduk;

class AdminController extends Controller
{
    /**
     * Dashboard utama
     */
    public function index()
    {
        // Total Data
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();

        // Statistik penduduk per dusun (aman jika kolom belum ada)
        if (Schema::hasTable('data_penduduks') && Schema::hasColumn('data_penduduks', 'dusun')) {
            $labelsPenduduk = DataPenduduk::select('dusun')
                ->whereNotNull('dusun')
                ->where('dusun', '!=', '')
                ->distinct()
                ->pluck('dusun')
                ->values();
            $dataPenduduk = $labelsPenduduk->map(function ($d) {
                return DataPenduduk::where('dusun', $d)->count();
            });
            if ($labelsPenduduk->isEmpty()) {
                $labelsPenduduk = collect(['Dusun 1','Dusun 2','Dusun 3']);
                $dataPenduduk = collect([0,0,0]);
            }
        } else {
            $labelsPenduduk = collect(['Dusun 1','Dusun 2','Dusun 3']);
            $dataPenduduk = collect([0,0,0]);
        }

        return view('pages.admin.dashboard.index', [
            'totalUsers'      => $totalUsers,
            'totalAdmin'      => $totalAdmin,
            'monthlyUsers'    => [],
            'labelsPenduduk'  => $labelsPenduduk,
            'dataPenduduk'    => $dataPenduduk,
        ])->with('menu', 'dashboard');
    }

    /**
     * Halaman Profil Admin
     */
    public function profile($id)
    {
        $data = Admin::findOrFail($id);
        return view('pages.admin.profile.index', [
            'menu' => 'profile',
            'data' => $data
        ]);
    }

    /**
     * Update Profil Admin
     */
    public function profile_update(Request $request)
    {
        $request->validate([
            'id'       => 'required|exists:admins,id',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'nullable|min:6'
        ]);

        $admin = Admin::findOrFail($request->id);
        $user  = User::findOrFail($request->id);

        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);
        $user->update($data);

        return redirect()->route('dashboard')->with('message', 'Profile berhasil diperbarui!');
    }
}
