<?php
namespace App\Http\Controllers;
use App\Models\Murid;
use Illuminate\Http\Request;

class MuridController extends Controller {
    public function store(Request $request, $kelas_id) {
        $request->validate([
            'nisn' => 'required|unique:murids',
            'nis'  => 'required|unique:murids',
            'nama' => 'required',
        ]);
        Murid::create([
            'kelas_id' => $kelas_id,
            'nisn'     => $request->nisn,
            'nis'      => $request->nis,
            'nama'     => $request->nama,
        ]);
        return back()->with('success', 'Murid berhasil ditambahkan ke kelas ini!');
    }
    public function update(Request $request, $id) {
        $murid = Murid::findOrFail($id);
        $murid->update($request->only(['nisn', 'nis', 'nama']));
        return back()->with('success', 'Data murid diperbarui!');
    }
    public function destroy($id) {
        Murid::findOrFail($id)->delete();
        return back()->with('success', 'Murid dihapus!');
    }
}