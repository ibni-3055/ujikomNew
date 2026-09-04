<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SMKN 4 Kota Bogor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0f172a;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
        }
        
        /* Content Styling */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .btn-primary { background-color: #2563eb; border-color: #2563eb; }
        .btn-success { background-color: #16a34a; border-color: #16a34a; }
        .btn-warning { background-color: #d97706; border-color: #d97706; color: white; }

        @media (max-width: 991.98px) {
            .sidebar { margin-left: -260px; }
            .main-content { margin-left: 0; }
            .sidebar.show { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar p-3 d-flex flex-column" id="sidebar">
        <!-- Logo -->
        <div class="d-flex align-items-center gap-3 px-2 py-3 mb-3 border-bottom border-secondary border-opacity-25">
            <div class="bg-primary text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-shield-lock-fill fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-white mb-0">SMKN 4 BOGOR</h6>
                <small class="text-muted" style="font-size: 0.75rem;">Admin Panel</small>
            </div>
        </div>

        <!-- Menu Navigation -->
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- Menu Dashboard -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>
</li>

<!-- Menu Data Kelas & Murid -->
<li class="nav-item">
    <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
        <i class="bi bi-door-closed-fill"></i> Data Kelas & Murid
    </a>
</li>

<!-- Menu Berita Sekolah -->
<li class="nav-item">
    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
        <i class="bi bi-newspaper"></i> Berita Sekolah
    </a>
</li>

<!-- Menu Galeri -->
<li class="nav-item">
    <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
        <i class="bi bi-images"></i> Galeri Sekolah
    </a>
</li>
        </ul>

        <!-- Bottom Menu -->
        <div class="pt-3 border-top border-secondary border-opacity-25">
            <a href="{{ url('/') }}" target="_blank" class="nav-link mb-2 text-info">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Web Utama
            </a>
            <div class="d-flex align-items-center justify-content-between px-2 pt-2">
    <div class="small">
        <div class="fw-bold text-truncate" style="max-width: 140px; color: #ffffff !important;">{{ Auth::user()->name ?? 'Administrator' }}</div>
        <div class="text-truncate" style="max-width: 140px; font-size: 0.75rem; color: #ffffff !important; opacity: 0.8;">{{ Auth::user()->email ?? 'admin@smkn4.sch.id' }}</div>
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Mobile Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-lg-none">
            <span class="fw-bold fs-5">Admin Panel</span>
            <button class="btn btn-dark" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
        </div>

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>