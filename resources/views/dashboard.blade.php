@extends('layouts.admin')

@section('title', 'Dashboard Admin - SMKN 4 Kota Bogor')
@section('page_title', 'Dashboard Admin')
@section('page_description', 'Selamat datang kembali! Ringkasan data pengelolaan konten website SMKN 4 Kota Bogor.')

@section('content')
<!-- Welcome Hero Banner -->
<div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);">
    <div class="card-body p-4 p-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <span class="badge bg-white text-dark mb-2 px-3 py-2 rounded-pill fw-semibold fs-6">
                    <i class="bi bi-clock-history me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
                <h2 class="fw-bold display-6 mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
                <p class="mb-0 text-white-50 fs-6">
                    Sistem informasi siap digunakan. Kamu dapat mengelola berita, galeri, data kelas, dan pengaturan pengguna SMKN 4 Kota Bogor melalui panel ini.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Cards Ringkasan Data -->
<div class="row g-4 mb-4">
    <!-- Total Admin -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase tracking-wider">Total Admin</span>
                    <div class="icon-shape bg-primary bg-opacity-10 text-primary fs-4 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-2">{{ \App\Models\User::count() }}</h2>
                <a href="{{ route('admin.index') }}" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center">
                    Kelola Admin <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Kelas -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase tracking-wider">Total Kelas</span>
                    <div class="icon-shape bg-info bg-opacity-10 text-info fs-4 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-2">{{ $totalKelas ?? (\App\Models\Kelas::count() ?? 0) }}</h2>
                <span class="text-muted small">Data Jurusan & Kelas</span>
            </div>
        </div>
    </div>

    <!-- Total Berita -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase tracking-wider">Total Berita</span>
                    <div class="icon-shape bg-success bg-opacity-10 text-success fs-4 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-2">{{ $totalBerita ?? (\App\Models\Berita::count() ?? 0) }}</h2>
                <a href="{{ route('admin.berita.index') }}" class="text-success text-decoration-none small fw-semibold d-inline-flex align-items-center">
                    Lihat Berita <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Galeri -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase tracking-wider">Total Galeri Foto</span>
                    <div class="icon-shape bg-warning bg-opacity-10 text-warning fs-4 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-images"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-2">{{ $totalGaleri ?? (\App\Models\Galeri::count() ?? 0) }}</h2>
                <a href="{{ route('admin.galeri.index') }}" class="text-warning text-decoration-none small fw-semibold d-inline-flex align-items-center">
                    Kelola Galeri <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Aksi Cepat</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-primary w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100">
                            <i class="bi bi-person-plus-fill fs-3"></i>
                            <div>
                                <div class="fw-bold">Tambah Admin</div>
                                <div class="small opacity-75">Kelola hak akses</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-success w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100">
                            <i class="bi bi-pencil-square fs-3"></i>
                            <div>
                                <div class="fw-bold">Buat Berita</div>
                                <div class="small opacity-75">Publikasikan artikel</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-warning w-100 p-3 rounded-3 text-start d-flex align-items-center gap-3 h-100">
                            <i class="bi bi-upload fs-3"></i>
                            <div>
                                <div class="fw-bold">Unggah Foto</div>
                                <div class="small opacity-75">Dokumentasi kegiatan</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berita Terbaru -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-newspaper text-success me-2"></i>Berita Baru Diterbitkan</h5>
                <a href="{{ route('admin.berita.index') }}" class="text-primary small fw-semibold text-decoration-none">Lihat Semua</a>
            </div>
            <div class="card-body p-4">
                @php
                    $latestBerita = \App\Models\Berita::latest()->take(3)->get();
                @endphp

                @forelse($latestBerita as $berita)
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <img src="{{ isset($berita->foto) ? asset('storage/' . $berita->foto) : asset('images/hero-sekolah.jpg') }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $berita->judul }}</h6>
                            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-light rounded-2 text-secondary">
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
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-images text-warning me-2"></i>Galeri Foto Terbaru</h5>
                <a href="{{ route('admin.galeri.index') }}" class="text-primary small fw-semibold text-decoration-none">Kelola Galeri</a>
            </div>
            <div class="card-body p-4">
                @php
                    $latestGaleri = \App\Models\Galeri::latest()->take(6)->get();
                @endphp

                @if($latestGaleri->count() > 0)
                    <div class="row g-3">
                        @foreach($latestGaleri as $galeri)
                            <div class="col-4 col-md-2">
                                <div class="position-relative rounded-3 overflow-hidden shadow-sm ratio ratio-1x1 group-hover">
                                    <img src="{{ isset($galeri->foto) ? asset('storage/' . $galeri->foto) : asset('images/hero-sekolah.jpg') }}" class="w-100 h-100 object-fit-cover" alt="{{ $galeri->judul ?? 'Foto Galeri' }}">
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
    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-door-open-fill text-info me-2"></i>Data Kelas</h5>
    <a href="{{ route('admin.kelas.index') }}" class="text-primary small fw-semibold text-decoration-none">Lihat Semua</a>
</div>
            <div class="card-body p-4">
                @php
                    $latestKelas = \App\Models\Kelas::latest()->take(4)->get();
                @endphp

                @forelse($latestKelas as $kelas)
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi bi-display text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">{{ $kelas->nama_kelas ?? $kelas->nama }}</h6>
                                <span class="text-muted" style="font-size: 11px;">{{ $kelas->jurusan ?? 'SMKN 4 Bogor' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.kelas.show', $kelas->id) }}" class="btn btn-sm btn-light rounded-2 text-secondary">
                            <i class="bi bi-arrow-right"></i>
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

        <!-- Portal Web Publik Card -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-body p-4 text-center">
                <div class="icon-shape bg-primary bg-opacity-10 text-primary fs-1 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                    <i class="bi bi-globe"></i>
                </div>
                <h5 class="fw-bold text-dark">Website Publik SMKN 4</h5>
                <p class="text-muted small">Cek tampilan terbaru portal resmi SMKN 4 Kota Bogor yang dilihat oleh pengunjung.</p>
                <a href="/" target="_blank" class="btn btn-primary w-100 rounded-3 fw-bold py-2">
                    <i class="bi bi-box-arrow-up-right me-2"></i> Buka Web Utama
                </a>
            </div>
        </div>

        <!-- System Info Card -->
        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-cpu-fill text-secondary me-2"></i>Info Sistem</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Versi Laravel</span>
                    <span class="fw-bold small text-dark">{{ app()->version() }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Versi PHP</span>
                    <span class="fw-bold small text-dark">{{ phpversion() }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Status Server</span>
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold">Aktif / Online</span>
                </div>
            </div>
        </div>
    </div> <!-- END KOLOM KANAN (col-lg-4) -->
</div>
@endsection