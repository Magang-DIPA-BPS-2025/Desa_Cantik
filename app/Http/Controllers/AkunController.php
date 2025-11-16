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

    // Form tambah akun (redirect ke index karena form ada di index)
    public function create()
    {
        return redirect()->route('akun.index');
    }

    // Simpan akun baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:admins,username',
                'password' => 'required|string|min:6',
            ]);

            $admin = Admin::create([
                'name' => $request->name,
                'username' => strtolower(str_replace(' ', '', $request->username)),
                'role' => $request->role ?? 'admin',
                'password' => $request->password, // mutator di model otomatis hash
            ]);

            return redirect()->route('akun.index')->with('message', 'store');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('message', 'Validasi gagal: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('message', 'Gagal membuat akun: ' . $e->getMessage());
        }
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
        try {
            $akun = Admin::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:admins,username,' . $akun->id,
                'password' => 'nullable|string|min:6',
            ]);

            // Update properti langsung agar mutator jalan
            $akun->name = $request->name;
            $akun->username = strtolower(str_replace(' ', '', $request->username));

            if ($request->filled('password')) {
                $akun->password = $request->password; // mutator otomatis hash
            }

            $akun->save();

            return redirect()->route('akun.index')->with('message', 'update');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('message', 'Validasi gagal: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('message', 'Gagal memperbarui akun: ' . $e->getMessage());
        }
    }

    // Hapus akun
    public function destroy($id)
    {
        try {
            $akun = Admin::findOrFail($id);
            
            // Cegah penghapusan akun sendiri
            if (session('user_id') == $akun->id) {
                return redirect()->route('akun.index')->with('message', 'Tidak dapat menghapus akun yang sedang digunakan');
            }
            
            $akun->delete();

            return redirect()->route('akun.index')->with('message', 'Akun berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('akun.index')->with('message', 'Gagal menghapus akun: ' . $e->getMessage());
        }
    }
}
