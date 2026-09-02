@extends('layouts.app')

@section('content')
<div class="row text-center mt-5">
    <div class="col-md-6 mb-3">
        <div class="card shadow border-0 p-4">
            <h3>🏫 Data Kelas & Murid</h3>
            <p class="text-muted">Kelola kelas dan penambahan murid otomatis per kelas.</p>
            <a href="{{ route('kelas.index') }}" class="btn btn-primary">Kelola Kelas</a>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow border-0 p-4">
            <h3>📰 Berita Sekolah</h3>
            <p class="text-muted">Kelola berita, deskripsi, foto, dan jam upload.</p>
            <a href="{{ route('berita.index') }}" class="btn btn-success">Kelola Berita</a>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 p-4">
            <h3>👤 Kelola Admin</h3>
            <p class="text-muted">Tambah admin, ubah password, dan hapus user.</p>
            <a href="{{ route('admin.index') }}" class="btn btn-warning text-white">Kelola Admin</a>
        </div>
    </div>
</div>
@endsection