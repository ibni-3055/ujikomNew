@extends('layouts.app')

@section('title', 'Dashboard Admin - SMKN 4 Kota Bogor')

@section('content')

{{-- Notifikasi Error / Penolakan Akses --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-5 me-3 text-danger"></i>
            <div>
                <strong>Akses Ditolak!</strong> {{ session('error') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Notifikasi Sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill fs-5 me-3 text-success"></i>
            <div>
                {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Welcome Hero Banner -->
<div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden" 
     style="background: linear-gradient(135deg, #0a2566 0%, #0d00c9 50%, #463fff 100%); position: relative;">
    
    <!-- Pattern Background Decoration -->

    <div class="card-body p-4 p-lg-5 position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 bg-white bg-opacity-10 text-white px-3 py-1.5 rounded-pill mb-3 backdrop-blur" style="font-size: 0.825rem; font-weight: 500;">
                    <i class="bi bi-clock-history text-warning"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
                <h2 class="fw-bold display-6 mb-2 text-white">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
                <p class="mb-0 text-white fs-6 col-lg-11" style="line-height: 1.6;">
                    Sistem informasi siap digunakan. Anda dapat mengelola berita, galeri, data kelas, dan pengaturan pengguna SMKN 4 Kota Bogor melalui panel kontrol ini.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Cards Ringkasan Data -->
<div class="row g-3 g-lg-4 mb-4">
    <!-- Total Admin -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white hover-card transition-all">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-secondary small fw-bold text-uppercase tracking-wider">Total Admin</span>
                    <div class="icon-shape bg-indigo-subtle text-indigo fs-4 rounded-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-2 fs-2">{{ \App\Models\User::count() }}</h3>
                <a href="{{ route('admin.index') }}" class="text-indigo text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1" style="color: #4f46e5;">
                    <span>Kelola Admin</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Kelas -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white hover-card transition-all">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-secondary small fw-bold text-uppercase tracking-wider">Total Kelas</span>
                    <div class="icon-shape bg-info bg-opacity-10 text-info fs-4 rounded-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-2 fs-2">{{ $totalKelas ?? (\App\Models\Kelas::count() ?? 0) }}</h3>
                <a href="{{ route('admin.kelas.index') }}" class="text-info text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                    <span>Data Jurusan & Kelas</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Berita -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white hover-card transition-all">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-secondary small fw-bold text-uppercase tracking-wider">Total Berita</span>
                    <div class="icon-shape bg-success bg-opacity-10 text-success fs-4 rounded-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-2 fs-2">{{ $totalBerita ?? (\App\Models\Berita::count() ?? 0) }}</h3>
                <a href="{{ route('admin.berita.index') }}" class="text-success text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                    <span>Lihat Berita</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Galeri -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white hover-card transition-all">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-secondary small fw-bold text-uppercase tracking-wider">Total Galeri Foto</span>
                    <div class="icon-shape bg-warning bg-opacity-10 text-warning fs-4 rounded-3 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                        <i class="bi bi-images"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-2 fs-2">{{ $totalGaleri ?? (\App\Models\Galeri::count() ?? 0) }}</h3>
                <a href="{{ route('admin.galeri.index') }}" class="text-warning text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                    <span>Kelola Galeri</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Akses Cepat, Berita, & Galeri Foto -->
    <div class="col-lg-8">
        <!-- Quick Action / Akses Cepat -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    <span>Aksi Cepat</span>
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('admin.index') }}" class="btn btn-light border w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100 btn-quick-action">
                            <div class="rounded-3 p-2 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                <i class="bi bi-person-plus-fill fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Tambah Admin</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Kelola hak akses</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-light border w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100 btn-quick-action">
                            <div class="rounded-3 p-2 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                <i class="bi bi-pencil-square fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Buat Berita</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Publikasikan artikel</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-light border w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100 btn-quick-action">
                            <div class="rounded-3 p-2 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                <i class="bi bi-upload fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Unggah Foto</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Dokumentasi kegiatan</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berita Terbaru -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-newspaper text-success"></i>
                    <span>Berita Baru Diterbitkan</span>
                </h6>
                <a href="{{ route('admin.berita.index') }}" class="text-primary small fw-semibold text-decoration-none">Lihat Semua</a>
            </div>
            <div class="card-body p-4">
                @php
                    $latestBerita = \App\Models\Berita::latest()->take(3)->get();
                @endphp

                @forelse($latestBerita as $berita)
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                        <img src="{{ isset($berita->foto) ? asset('storage/' . $berita->foto) : asset('images/hero-sekolah.jpg') }}" 
                             class="rounded-3 flex-shrink-0" 
                             style="width: 64px; height: 64px; object-fit: cover;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.925rem;">{{ $berita->judul }}</h6>
                            <span class="text-muted small d-block"><i class="bi bi-calendar3 me-1"></i> {{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-light border rounded-circle p-0 d-flex align-items-center justify-content-center text-secondary flex-shrink-0" style="width: 34px; height: 34px;">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted small">
                        <i class="bi bi-journal-x fs-2 d-block mb-2 text-secondary"></i>
                        Belum ada berita yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Galeri Foto Terbaru -->
        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-images text-warning"></i>
                    <span>Galeri Foto Terbaru</span>
                </h6>
                <a href="{{ route('admin.galeri.index') }}" class="text-primary small fw-semibold text-decoration-none">Kelola Galeri</a>
            </div>
            <div class="card-body p-4">
                @php
                    $latestGaleri = \App\Models\Galeri::latest()->take(6)->get();
                @endphp

                @if($latestGaleri->count() > 0)
                    <div class="row g-2 g-md-3">
                        @foreach($latestGaleri as $galeri)
                            <div class="col-4 col-md-2">
                                <div class="position-relative rounded-3 overflow-hidden shadow-sm ratio ratio-1x1 border">
                                    <img src="{{ isset($galeri->foto) ? asset('storage/' . $galeri->foto) : asset('images/hero-sekolah.jpg') }}" 
                                         class="w-100 h-100 object-fit-cover" 
                                         alt="{{ $galeri->judul ?? 'Foto Galeri' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-muted small">
                        <i class="bi bi-image-fill fs-2 d-block mb-2 text-secondary"></i>
                        Belum ada foto galeri yang diunggah.
                    </div>
                @endif
            </div>
        </div>
    </div> <!-- END KOLOM KIRI (col-lg-8) -->

    <!-- Kolom Kanan: Daftar Kelas, Info Web, Status Server -->
    <div class="col-lg-4">
        <!-- List Daftar Kelas Terbaru -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-door-open-fill text-info"></i>
                    <span>Data Kelas</span>
                </h6>
                <a href="{{ route('admin.kelas.index') }}" class="text-primary small fw-semibold text-decoration-none">Lihat Semua</a>
            </div>
            <div class="card-body p-4">
                @php
                    $latestKelas = \App\Models\Kelas::latest()->take(4)->get();
                @endphp

                @forelse($latestKelas as $kelas)
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light rounded-3 p-2 d-flex align-items-center justify-content-center text-primary flex-shrink-0" style="width: 38px; height: 38px;">
                                <i class="bi bi-display fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">{{ $kelas->nama_kelas ?? $kelas->nama }}</h6>
                                <span class="text-muted" style="font-size: 0.75rem;">{{ $kelas->jurusan ?? 'SMKN 4 Bogor' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.kelas.show', $kelas->id) }}" class="btn btn-sm btn-light border rounded-circle p-0 d-flex align-items-center justify-content-center text-secondary flex-shrink-0" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-3 text-muted small">
                        <i class="bi bi-journal-album fs-3 d-block mb-1 text-secondary"></i>
                        Belum ada data kelas.
                    </div>
                @endforelse
            </div>
        </div>


        <!-- System Info Card -->
        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-cpu-fill text-secondary"></i>
                    <span>Informasi Sistem</span>
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-light">
                    <span class="text-muted small">Versi Framework</span>
                    <span class="badge bg-light text-dark border fw-medium">Laravel v{{ app()->version() }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-light">
                    <span class="text-muted small">Versi PHP</span>
                    <span class="badge bg-light text-dark border fw-medium">v{{ phpversion() }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Status Server</span>
                    <span class="badge bg-success bg-opacity-10 text-success fw-semibold">
                        <i class="bi bi-dot"></i> Online
                    </span>
                </div>
            </div>
        </div>
    </div> <!-- END KOLOM KANAN (col-lg-4) -->
</div>

<!-- Custom CSS Tambahan untuk Animasi Halus -->
<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.06) !important;
    }
    .btn-quick-action {
        transition: all 0.2s ease;
    }
    .btn-quick-action:hover {
        background-color: #ffffff !important;
        border-color: #4f46e5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>
@endsection