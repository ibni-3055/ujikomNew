<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Generate email unik otomatis di sistem agar database tidak error
        $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->name));
        $emailOtomatis = $cleanName . time() . '@smkn4.sch.id';

        User::create([
            'name'     => $request->name,
            'email'    => $emailOtomatis,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Hanya validasi nama, TIDAK butuh email
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data = [
            'name' => $request->name,
        ];

        // Jika password diisi saat edit, update password baru
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cegah admin menghapus akunnya sendiri yang sedang login
        if (auth()->id() == $id) {
            return back()->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri yang sedang digunakan!');
        }

        User::findOrFail($id)->delete();
        return back()->with('success', 'Admin berhasil dihapus!');
    }
}