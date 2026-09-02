<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    // ... rute dashboard, kelas, berita yang sudah ada ...
    
    // CRUD Admin
    Route::resource('admin', AdminController::class)->except(['create', 'edit', 'show']);
});

// 1. Halaman Awal / Beranda Utama
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rute CRUD (Harus Login)
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('berita', BeritaController::class);

    Route::post('kelas/{kelas_id}/murid', [MuridController::class, 'store'])->name('murid.store');
    Route::put('murid/{id}', [MuridController::class, 'update'])->name('murid.update');
    Route::delete('murid/{id}', [MuridController::class, 'destroy'])->name('murid.destroy');
});

require __DIR__.'/auth.php';