<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

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

        // Data registrasi user per bulan
        $monthlyUsers = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyUsers[] = User::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }

        return view('pages.admin.dashboard.index', compact(
            'totalUsers',
            'totalAdmin',
            'monthlyUsers'
        ))->with('menu', 'dashboard');
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
