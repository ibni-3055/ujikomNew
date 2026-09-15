<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMKN 4 Kota Bogor')</title>

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
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-people-fill"></i> Kelola Admin
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-door-closed-fill"></i> Kelola Kelas
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-slate-900 mb-1">@yield('page_title', 'Admin Panel')</h3>
                <p class="text-muted small mb-0">@yield('page_description', 'Sistem Pengelolaan Konten Website SMKN 4 Kota Bogor.')</p>
            </div>
            <button class="btn btn-dark d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>