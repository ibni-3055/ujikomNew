<?php
namespace App\Http\Controllers;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller {
    public function index() {
        $kelases = Kelas::latest()->get();
        return view('kelas.index', compact('kelases'));
    }
    public function store(Request $request) {
        $request->validate(['nama_kelas' => 'required|unique:kelas,nama_kelas']);
        Kelas::create(['nama_kelas' => $request->nama_kelas]);
        return back()->with('success', 'Kelas berhasil ditambah!');
    }
    public function show($id) {
        $kelas = Kelas::with('murids')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }
    public function destroy($id) {
        Kelas::findOrFail($id)->delete();
        return back()->with('success', 'Kelas dihapus!');
    }
}