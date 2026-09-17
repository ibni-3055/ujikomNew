<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Middleware untuk membatasi akses hanya untuk Super Admin
     */
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (auth()->check() && auth()->user()->role !== 'super_admin') {
                    return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak! Hanya Super Admin yang dapat mengelola data admin.');
                }
                return $next($request);
            },
        ];
    }

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
            'role'     => 'admin', // Default user baru sebagai admin biasa
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'password' => 'nullable|string|min:6', // Nullable agar password tidak wajib diisi
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;

    // Hanya update password jika input password diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Data admin berhasil diperbarui!');
}

    // Menghapus user
    public function destroy($id)
    {
        if (User::count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus satu-satunya user admin!');
        }

        $user = User::findOrFail($id);

        // Mencegah menghapus diri sendiri saat login sebagai Super Admin
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Kamu tidak dapat menghapus akunmu sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User admin berhasil dihapus!');
    }
}