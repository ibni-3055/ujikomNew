<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - SMKN 4 Kota Bogor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css'])

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f1f5f9; 
        }
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            position: fixed; 
            top: 0; 
            left: 0; 
            background-color: #0f172a; 
            z-index: 1000; 
            transition: all 0.3s ease-in-out;
        }
        .main-content { 
            margin-left: 260px; 
            padding: 2.5rem; 
            transition: all 0.3s ease-in-out;
        }
        .sidebar .nav-link { 
            color: #94a3b8; 
            padding: 0.85rem 1.2rem; 
            border-radius: 0.75rem; 
            font-weight: 500; 
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            color: #ffffff; 
            background: linear-gradient(90deg, #1e293b 0%, #334155 100%); 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link.active i {
            color: #38bdf8;
        }
        .sidebar .nav-link i { 
            font-size: 1.25rem; 
            margin-right: 0.85rem; 
        }
        .card-custom {
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        @media (max-width: 991.98px) {
            .sidebar { margin-left: -260px; }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .sidebar.show { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navbar -->
    <aside class="sidebar p-3 d-flex flex-column" id="sidebar">
        <div class="d-flex align-items-center gap-3 px-2 py-3 mb-3 border-bottom border-slate-800">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4" height="40" class="rounded">
            <div>
                <span class="fw-bold text-white fs-6 d-block leading-none">ADMIN PANEL</span>
                <span class="small text-white" style="font-size: 0.7rem;">SMKN 4 KOTA BOGOR</span>
            </div>
        </div>

        <ul class="nav nav-pills flex-column gap-1 mb-auto">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>

            <!-- Kelola Admin / Users -->
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-people-fill"></i> Kelola Admin
                </a>
            </li>

            <!-- Kelola Kelas -->
            <li class="nav-item">
                <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-door-closed-fill"></i> Kelola Kelas
                </a>
            </li>

            <!-- Kelola Berita -->
            <li class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-newspaper"></i> Kelola Berita
                </a>
            </li>

            <!-- Kelola Galeri -->
            <li class="nav-item">
                <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-images"></i> Kelola Galeri
                </a>
            </li>

            <!-- Link Web Utama -->
            <li class="nav-item mt-3">
                <a href="{{ url('/') }}" target="_blank" class="nav-link d-flex align-items-center text-info bg-info bg-opacity-10">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Web Publik
                </a>
            </li>
        </ul>

        <!-- Profile & Logout -->
        <div class="pt-3 border-top border-slate-800">
            <div class="d-flex align-items-center justify-content-between px-2 bg-slate-900 p-2 rounded-3">
                <div class="text-white small">
                    <div class="fw-bold text-truncate" style="max-width: 140px;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2" title="Keluar">
                        <i class="bi bi-box-arrow-right fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Header Page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-slate-900 mb-1">Pengelolaan Berita Sekolah</h3>
                <p class="text-muted small mb-0">Unggah berita terbaru, perbarui konten, atau hapus berita publikasi.</p>
            </div>
            <button class="btn btn-dark d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>

        <div class="row g-4">
            <!-- Form Upload Berita -->
            <div class="col-lg-4">
                <div class="card card-custom p-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-cloud-upload-fill text-success"></i> Upload Berita Baru
                    </h5>

                    @if(session('success'))
                        <div class="alert alert-success rounded-3 small border-0 shadow-sm">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Judul Berita</label>
                            <input type="text" name="judul" class="form-control rounded-3" placeholder="Masukkan judul berita..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Deskripsi / Isi Berita</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="4" placeholder="Tuliskan ringkasan / isi berita..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Foto Header</label>
                            <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted">Tanggal Upload</label>
                            <input type="datetime-local" name="tanggal_upload" class="form-control rounded-3" value="{{ date('Y-m-d\TH:i') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 rounded-3 py-2 fw-semibold">
                            <i class="bi bi-send-fill me-1"></i> Terbitkan Berita
                        </button>
                    </form>
                </div>
            </div>

            <!-- Daftar Berita Terbit -->
            <div class="col-lg-8">
                <div class="card card-custom p-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-collection-play-fill text-primary"></i> Daftar Berita Published
                    </h5>
                    
                    <div class="row g-3">
                        @forelse($berita ?? $beritas ?? [] as $b)
                            @php
                                $gambarPath = $b->foto ?? $b->gambar ?? $b->image ?? null;
                            @endphp
                            <div class="col-md-6">
                                <div class="card border rounded-4 overflow-hidden h-100 shadow-sm hover-shadow transition">
                                    @if($gambarPath)
                                        <img src="{{ asset('storage/' . $gambarPath) }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $b->judul }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 160px;">
                                            <i class="bi bi-image fs-1 opacity-50"></i>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold text-dark mb-1">{{ $b->judul }}</h6>
                                        <p class="small text-muted mb-2" style="font-size: 0.775rem;">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ isset($b->tanggal_upload) ? \Carbon\Carbon::parse($b->tanggal_upload)->format('d M Y - H:i') : $b->created_at->format('d M Y') }}
                                        </p>
                                        <p class="card-text text-secondary small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 0.85rem;">
                                            {{ $b->deskripsi ?? $b->isi ?? $b->ringkasan }}
                                        </p>

                                        <div class="d-flex gap-2 mt-auto">
                                            <!-- Tombol Edit Modal -->
                                            <button class="btn btn-warning btn-sm text-white rounded-3 w-100 fw-semibold" data-bs-toggle="modal" data-bs-target="#editBeritaModal{{ $b->id }}">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </button>

                                            <!-- Form Hapus -->
                                            <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" class="w-100">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-3" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Berita -->
                            <div class="modal fade" id="editBeritaModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 shadow">
                                        <form action="{{ route('admin.berita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-bottom-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit Berita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Judul Berita</label>
                                                    <input type="text" name="judul" class="form-control rounded-3" value="{{ $b->judul }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Deskripsi / Isi Berita</label>
                                                    <textarea name="deskripsi" class="form-control rounded-3" rows="4" required>{{ $b->deskripsi ?? $b->isi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Ganti Foto <small class="text-muted fw-normal">(Biarkan kosong jika tidak diganti)</small></label>
                                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top-0 pt-0">
                                                <button type="button" class="btn btn-light rounded-3 fw-semibold" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-3 fw-semibold px-4">Simpan Perubahan</button>
                                            </div>
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