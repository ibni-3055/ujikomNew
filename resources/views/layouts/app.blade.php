<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SMKN 4 Kota Bogor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4f46e5;
            --sidebar-bg: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            z-index: 1045;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid #1e293b;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.7rem 1rem;
            border-radius: 0.6rem;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar .nav-link:hover {
            color: #f8fafc;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--primary-color);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        .sidebar-section-title {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: #64748b;
            text-transform: uppercase;
            padding: 0 1rem;
            margin-top: 1.25rem;
            margin-bottom: 0.5rem;
        }

        /* Topbar Header */
        .topbar {
            margin-left: var(--sidebar-width);
            height: 64px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            z-index: 1030;
        }

        /* Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.75rem 2rem;
            min-height: calc(100vh - 64px);
            transition: all 0.3s ease;
        }

        /* Mobile Overlay Background */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1040;
        }

        @media (max-width: 991.98px) {
            .sidebar { 
                transform: translateX(-100%); 
            }
            .sidebar.show { 
                transform: translateX(0); 
            }
            .topbar, .main-content { 
                margin-left: 0 !important; 
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Overlay Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar Navbar -->
    <aside class="sidebar p-3 d-flex flex-column" id="sidebar">
        <!-- Logo & Brand Header -->
        <div class="d-flex align-items-center gap-3 px-2 py-2 mb-2 border-bottom border-slate-800" style="border-color: #1e293b !important;">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4" height="38" class="rounded">
            <div>
                <span class="fw-bold text-white fs-6 d-block lh-1">ADMIN PANEL</span>
                <span class="text-secondary" style="font-size: 0.7rem; font-weight: 500;">SMKN 4 KOTA BOGOR</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="overflow-y-auto flex-grow-1 pe-1">
            <div class="sidebar-section-title">UTAMA</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill fs-6"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-section-title">MANAJEMEN DATA</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('users.*') || request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="bi bi-people-fill fs-6"></i>
                        <span>Kelola Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                        <i class="bi bi-door-closed-fill fs-6"></i>
                        <span>Kelola Kelas</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-section-title">KONTEN WEBSITE</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper fs-6"></i>
                        <span>Kelola Berita</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                        <i class="bi bi-images fs-6"></i>
                        <span>Kelola Galeri</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile & Logout (Sidebar Footer) -->
        <div class="mt-auto pt-3 border-top" style="border-color: #1e293b !important;">
            <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background-color: #1e293b;">
                <!-- User Info -->
                <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0" 
                         style="width: 36px; height: 36px; font-size: 0.85rem; background-color: var(--primary-color);">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    
                    <div class="d-flex flex-column text-truncate">
                        <span class="fw-bold text-white small text-truncate" title="{{ Auth::user()->name ?? 'Administrator' }}">
                            {{ Auth::user()->name ?? 'Administrator' }}
                        </span>
                        <span class="badge {{ (Auth::user()->role ?? '') === 'super_admin' ? 'bg-warning text-dark' : 'bg-indigo-subtle text-indigo' }}" 
                              style="font-size: 0.65rem; width: fit-content; background-color: rgba(79, 70, 229, 0.2); color: #818cf8;">
                            {{ (Auth::user()->role ?? '') === 'super_admin' ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>
                </div>

                <!-- Logout Button -->
                <button type="button" 
                        class="btn btn-outline-danger btn-sm border-0 rounded-3 p-0 d-flex align-items-center justify-content-center text-white-50 hover-text-white" 
                        data-bs-toggle="modal" 
                        data-bs-target="#logoutModal" 
                        title="Keluar"
                        style="width: 32px; height: 32px;">
                    <i class="bi bi-box-arrow-right fs-6"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- Top Navigation Header -->
    <header class="topbar sticky-top d-flex align-items-center px-3 px-lg-4">
        <button class="btn btn-light border-0 d-lg-none me-2" onclick="toggleSidebar()">
            <i class="bi bi-list fs-5"></i>
        </button>

        <div class="d-none d-sm-flex align-items-center gap-2 text-muted small">
            <i class="bi bi-calendar3"></i>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        </div>

        <div class="ms-auto d-flex align-items-center gap-2">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-light border text-secondary fw-semibold rounded-3 px-3 d-inline-flex align-items-center gap-2">
                <i class="bi bi-globe"></i>
                <span class="d-none d-sm-inline">Lihat Website</span>
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden text-dark bg-white">
                <div class="modal-body p-4 text-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                        <i class="bi bi-box-arrow-right fs-3"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Konfirmasi Keluar</h6>
                    <p class="text-muted small mb-4">Apakah Anda yakin ingin keluar dari sistem?</p>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light w-50 fw-semibold rounded-3 py-2 small" data-bs-dismiss="modal">Batal</button>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-50">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 fw-semibold rounded-3 py-2 small shadow-sm">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
    </script>
</body>
</html>