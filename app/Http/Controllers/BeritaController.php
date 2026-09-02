<?php
namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller {
    public function index() {
        $beritas = Berita::latest('tanggal_upload')->get();
        return view('berita.index', compact('beritas'));
    }
    public function store(Request $request) {
        $request->validate([
            'judul'          => 'required',
            'deskripsi'      => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_upload' => 'required|date',
        ]);

        $path = $request->file('foto') ? $request->file('foto')->store('berita', 'public') : null;

        Berita::create([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'foto'           => $path,
            'tanggal_upload' => $request->tanggal_upload,
        ]);
        return back()->with('success', 'Berita berhasil terbit!');
    }
    public function destroy($id) {
        $berita = Berita::findOrFail($id);
        if ($berita->foto) Storage::disk('public')->delete($berita->foto);
        $berita->delete();
        return back()->with('success', 'Berita dihapus!');
    }
}