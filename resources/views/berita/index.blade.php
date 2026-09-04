<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - SMKN 4 Kota Bogor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Google Sans', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0f172a;
            z-index: 1000;
        }
        .main-content {
            margin-left: 260px;
            padding: 2rem;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
        }
        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }
        @media (max-width: 991.98px) {
            .sidebar { margin-left: -260px; transition: all 0.3s; }
            .main-content { margin-left: 0; }
            .sidebar.show { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar p-3 d-flex flex-column" id="sidebar">
        <!-- Logo Header -->
        <div class="d-flex align-items-center gap-2 px-2 py-3 mb-3 border-bottom border-secondary border-opacity-25">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4" height="38">
            <span class="fw-bold text-white fs-6">ADMIN PANEL</span>
        </div>

        <!-- Menu Links -->
        <ul class="nav nav-pills flex-column gap-1 mb-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-door-closed"></i> Kelola Kelas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-newspaper"></i> Kelola Berita
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-images"></i> Kelola Galeri
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}" target="_blank" class="nav-link d-flex align-items-center text-info mt-2">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Web Publik
                </a>
            </li>
        </ul>

        <!-- Profil Ringkas & Logout -->
        <div class="pt-3 border-top border-secondary border-opacity-25">
            <div class="d-flex align-items-center justify-content-between px-2">
                <div class="small">
                    <div class="fw-bold text-truncate" style="max-width: 140px; color: #ffffff !important;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <small class="d-block text-truncate" style="max-width: 140px; font-size: 0.75rem; color: #ffffff !important; -webkit-text-fill-color: #ffffff !important;">{{ Auth::user()->email ?? 'admin@smkn4.sch.id' }}</small>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" title="Keluar">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        
        <!-- Topbar Mobile Toggle & Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Pengelolaan Berita Sekolah</h3>
                <p class="text-muted small mb-0">Unggah berita terbaru atau hapus berita yang sudah dipublikasikan.</p>
            </div>
            <button class="btn btn-dark d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="row g-4">
            <!-- Form Upload Berita -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-cloud-upload-fill text-success me-2"></i>Upload Berita</h5>
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Deskripsi / Isi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan berita..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Foto Header</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Tanggal & Jam Upload</label>
                            <input type="datetime-local" name="tanggal_upload" class="form-control" value="{{ date('Y-m-d\TH:i') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-semibold">
                            <i class="bi bi-send-fill me-1"></i> Terbitkan Berita
                        </button>
                    </form>
                </div>
            </div>

            <!-- Daftar Berita Terbit -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-collection-play-fill text-primary me-2"></i>Daftar Berita Published</h5>
                    <div class="row g-3">
                        @forelse($berita ?? $beritas ?? [] as $b)
                            @php
                                $gambarPath = $b->foto ?? $b->gambar ?? $b->image ?? null;
                            @endphp
                            <div class="col-md-6">
                                <div class="card border rounded-3 overflow-hidden h-100 shadow-sm">
                                    @if($gambarPath)
                                        <img src="{{ asset('storage/' . $gambarPath) }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $b->judul }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 160px;">
                                            <i class="bi bi-image fs-1 opacity-50"></i>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold text-dark mb-1">{{ $b->judul }}</h6>
                                        <p class="small text-muted mb-2">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ isset($b->tanggal_upload) ? \Carbon\Carbon::parse($b->tanggal_upload)->format('d F Y - H:i') : $b->created_at->format('d F Y') }}
                                        </p>
                                        <p class="card-text text-secondary small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $b->deskripsi ?? $b->isi ?? $b->ringkasan }}
                                        </p>

                                        <form action="{{ url('/admin/berita/' . $b->id) }}" method="POST" class="mt-auto">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Yakin hapus berita ini?')">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-5">
                                <i class="bi bi-newspaper fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada berita yang diterbitkan.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>