<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Tampilkan halaman galeri.
     */
    public function index()
    {
        $galeris = Galeri::latest()->get();
        // Ubah dari 'admin.galeri.index' menjadi 'galeri.index'
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Simpan foto galeri baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'nama_tempat' => $request->nama_tempat,
            'foto' => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($galeri->foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}