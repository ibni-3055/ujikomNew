<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Models\Kelas;
use App\Models\Berita;
use App\Models\Galeri;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Dapat Diakses Semua Pengunjung)
|--------------------------------------------------------------------------
*/

// Halaman Beranda Utama
Route::get('/', function () {
    $kelases = Kelas::all();
    $beritas = Berita::latest()->take(6)->get();
    $galeris = Galeri::latest()->take(6)->get();

    return view('welcome', compact('kelases', 'beritas', 'galeris'));
});

// Halaman Daftar Semua Berita Publik
// Halaman Berita Publik (Ubah 'berita.index' jadi 'berita')
Route::get('/berita', function () {
    $beritas = Berita::latest()->get(); 
    return view('berita', compact('beritas')); // <--- UBAH DI SINI!
});

// Halaman Detail Single Berita Publik (Saat Klik "Baca Selengkapnya")
Route::get('/berita/{id}', function ($id) {
    $berita = Berita::findOrFail($id);
    return view('berita.show', compact('berita'));
})->name('berita.show.publik');

// Halaman Jurusan Publik
Route::get('/jurusan', function () {
    return view('jurusan');
});

// Halaman Galeri Publik
Route::get('/galeri', function () {
    $galeris = Galeri::latest()->get();
    return view('galeri', compact('galeris'));
});


/*
|--------------------------------------------------------------------------
| 2. RUTE ADMIN (Wajib Login - URL Menggunakan Awalan /admin/...)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalKelas = Kelas::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();

        return view('dashboard', compact('totalKelas', 'totalBerita', 'totalGaleri'));
    })->name('dashboard');

    // Group Rute Management Admin
    // URL Admin Berita menjadi: /admin/berita
    // Nama Route Admin Berita menjadi: admin.berita.index, admin.berita.destroy, dll.
    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::resource('users', AdminController::class)->except(['create', 'edit', 'show']);

        Route::resource('kelas', KelasController::class);
        Route::post('kelas/{kelas_id}/murid', [MuridController::class, 'store'])->name('murid.store');
        Route::put('murid/{id}', [MuridController::class, 'update'])->name('murid.update');
        Route::delete('murid/{id}', [MuridController::class, 'destroy'])->name('murid.destroy');
        
        Route::resource('galeri', GaleriController::class);

        // CRUD Berita Khusus Admin
        Route::resource('berita', BeritaController::class);
    });

});

require __DIR__.'/auth.php';