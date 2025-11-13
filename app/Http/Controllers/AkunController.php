<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    // Tampilkan semua akun
    public function index()
    {
        $datas = Admin::latest()->get();
        return view('pages.admin.akun.index', [
            'menu' => 'akun',
            'datas' => $datas
        ]);
    }

    // Simpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => strtolower(str_replace(' ', '', $request->username)),
            'role' => 'admin',
            'password' => $request->password, // mutator di model otomatis hash
        ]);

        return redirect()->route('akun.index')->with('message', 'Akun berhasil dibuat');
    }

    // Edit akun
    public function edit($id)
    {
        $data = Admin::findOrFail($id);
        return view('pages.admin.akun.edit', [
            'menu' => 'akun',
            'datas' => $data
        ]);
    }

    // Update akun
    public function update(Request $request, $id)
    {
        $akun = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,' . $akun->id,
        ]);

        // Update properti langsung agar mutator jalan
        $akun->name = $request->name;
        $akun->username = strtolower(str_replace(' ', '', $request->username));

        if ($request->password) {
            $akun->password = $request->password; // mutator otomatis hash
        }

        $akun->save();

        return redirect()->route('akun.index')->with('message', 'Akun berhasil diperbarui');
    }

    // Hapus akun
    public function destroy($id)
    {
        $akun = Admin::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.index')->with('message', 'Akun berhasil dihapus');
    }
}
