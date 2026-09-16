<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - SMKN 4 Kota Bogor</title>

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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header Page -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2 d-inline-flex align-items-center gap-1">
                    <i class="bi bi-shield-lock-fill fs-6"></i> Hak Akses Pengguna
                </span>
                <h3 class="fw-bold text-dark mb-1">Kelola Pengguna & Admin</h3>
                <p class="text-muted small mb-0">Tambah, perbarui data akun, atau atur kata sandi administrator sistem.</p>
            </div>
            <button class="btn btn-dark d-lg-none shadow-sm" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>

        <div class="row g-4">
            <!-- Card Form Tambah Admin -->
            <div class="col-lg-4">
                <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="p-4 bg-primary bg-opacity-10 border-bottom border-light">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="bi bi-person-plus-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Tambah Admin Baru</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Buat kredensial akun baru</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <!-- Alert Notifikasi -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 small mb-3" role="alert">
                                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-3 small mb-3">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Nama User</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted rounded-start-3"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="form-control bg-light border-start-0 rounded-end-3" placeholder="Masukkan nama user..." value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
    <label class="form-label small fw-bold text-secondary">Password (Minimal 8 Karakter)</label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted rounded-start-3"><i class="bi bi-key"></i></span>
        <input type="password" id="addPassword" name="password" class="form-control bg-light border-start-0 border-end-0" placeholder="••••••••" required>
        <button class="btn btn-light border border-start-0 text-muted rounded-end-3" type="button" onclick="togglePassword('addPassword', this)">
            <i class="bi bi-eye-slash"></i>
        </button>
    </div>
</div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2.5 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-check-circle me-1"></i> Simpan Admin Baru
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Admin -->
            <div class="col-lg-8">
                <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-dark text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="bi bi-people-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Daftar Akun Admin</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Daftar akun administrator terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light border-bottom">
                                <tr class="text-secondary small fw-semibold">
                                    <th class="py-3 ps-4" style="width: 50px;">NO</th>
                                    <th class="py-3">NAMA USER</th>
                                    <th class="py-3">PASSWORD</th>
                                    <th class="py-3 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $u)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                {{ strtoupper(substr($u->name, 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold text-dark">{{ $u->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary border fw-normal px-2.5 py-1.5 rounded-2 font-monospace">••••••••</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm text-white rounded-2 px-3 me-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $u->id }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>

                                        <form action="{{ route('admin.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm rounded-2 px-3">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Admin -->
                                <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                            <form action="{{ route('admin.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header bg-dark text-white p-4 border-0">
                                                    <h5 class="modal-title fw-bold fs-6">Edit Admin: {{ $u->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-semibold text-muted">Nama User</label>
                                                        <input type="text" name="name" class="form-control bg-light rounded-3" value="{{ $u->name }}" required>
                                                    </div>
                                                    <div class="mb-2">
    <label class="form-label small fw-semibold text-muted">Password Baru <small class="text-muted fw-normal">(Kosongkan jika tidak diubah)</small></label>
    <div class="input-group">
        <input type="password" id="editPassword{{ $u->id }}" name="password" class="form-control bg-light rounded-start-3 border-end-0" minlength="6" placeholder="Password baru...">
        <button class="btn btn-light border border-start-0 text-muted rounded-end-3" type="button" onclick="togglePassword('editPassword{{ $u->id }}', this)">
            <i class="bi bi-eye-slash"></i>
        </button>
    </div>
</div>
                                                </div>
                                                <div class="modal-footer bg-light p-3 border-top-0">
                                                    <button type="button" class="btn btn-light rounded-3 fw-semibold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary rounded-3 fw-semibold px-4 shadow-sm">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>
</body>
</html>