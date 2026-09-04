<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMKN 4 Kota Bogor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Google Sans', sans-serif; background-color: #f8fafc; }
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #0f172a; z-index: 1000; }
        .main-content { margin-left: 260px; padding: 2rem; }
        .sidebar .nav-link { color: #94a3b8; padding: 0.8rem 1.2rem; border-radius: 0.5rem; font-weight: 500; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #ffffff; background-color: #1e293b; }
        .sidebar .nav-link i { font-size: 1.2rem; margin-right: 0.75rem; }
        @media (max-width: 991.98px) {
            .sidebar { margin-left: -260px; transition: all 0.3s; }
            .main-content { margin-left: 0; }
            .sidebar.show { margin-left: 0; }
        }
    </style>
</head>
<body>

    <aside class="sidebar p-3 d-flex flex-column" id="sidebar">
        <div class="d-flex align-items-center gap-2 px-2 py-3 mb-3 border-bottom border-secondary border-opacity-25">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4" height="38">
            <span class="fw-bold text-white fs-6">ADMIN PANEL</span>
        </div>

        <ul class="nav nav-pills flex-column gap-1 mb-auto">
            <!-- Dashboard -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>
</li>

<!-- Kelola Kelas (Tambahkan admin.) -->
<li class="nav-item">
    <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }} d-flex align-items-center">
        <i class="bi bi-door-closed"></i> Kelola Kelas
    </a>
</li>

<!-- Kelola Berita (Tambahkan admin.) -->
<li class="nav-item">
    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }} d-flex align-items-center">
        <i class="bi bi-newspaper"></i> Kelola Berita
    </a>
</li>

<!-- Kelola Galeri (Jika ada, tambahkan admin.) -->
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

        <div class="pt-3 border-top border-secondary border-opacity-25">
            <div class="d-flex align-items-center justify-content-between px-2">
                <div class="text-white small">
                    <div class="fw-bold">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email ?? 'admin@smkn4.sch.id' }}</div>
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

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Dashboard Admin</h3>
                <p class="text-muted small mb-0">Ringkasan data pengelolaan konten website SMKN 4 Kota Bogor.</p>
            </div>
            <button class="btn btn-dark d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-3">
                            <i class="bi bi-door-open-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Kelas</h6>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalKelas ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-3">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Berita</h6>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalBerita ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-3">
                            <i class="bi bi-images"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small fw-semibold">Total Galeri Foto</h6>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalGaleri ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>