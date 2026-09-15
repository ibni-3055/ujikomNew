<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // <-- Ini yang tadi kurang
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    // Menambah user baru
    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->name));
    $emailOtomatis = $cleanName . time() . '@smkn4.sch.id';

    User::create([
        'name'     => $request->name,
        'email'    => $emailOtomatis,
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Admin baru berhasil ditambahkan!');
}

    // Menghapus user
    public function destroy($id)
    {
        if (User::count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus satu-satunya user admin!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User admin berhasil dihapus!');
    }
}