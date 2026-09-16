<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Kelas;
use App\Models\Berita;
use App\Models\Galeri;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // === BISA DIAKSES OLEH SEMUA ADMIN & SUPER ADMIN ===
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', BeritaController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('murid', MuridController::class);

    // === HANYA BISA DIAKSES OLEH SUPER ADMIN ===
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('users', AdminManagementController::class); // CRUD Kelola Admin
    });
});

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

// Halaman Berita Publik
Route::get('/berita', function () {
    $beritas = Berita::latest()->get(); 
    return view('berita', compact('beritas'));
});

// Halaman Detail Single Berita Publik
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
| 2. RUTE ADMIN (Wajib Login)
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

    // Group Rute Management Admin (/admin/...)
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Rute Kelola Admin (Sekarang URL-nya jadi /admin)
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');

        // Resource Admin Lainnya
        Route::resource('kelas', KelasController::class);
        Route::post('kelas/{kelas_id}/murid', [MuridController::class, 'store'])->name('murid.store');
        Route::put('murid/{id}', [MuridController::class, 'update'])->name('murid.update');
        Route::delete('murid/{id}', [MuridController::class, 'destroy'])->name('murid.destroy');
        
        Route::resource('galeri', GaleriController::class);
        Route::resource('berita', BeritaController::class);
    });

});

require __DIR__.'/auth.php';