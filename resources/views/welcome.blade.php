<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SMK Negeri 4 Kota Bogor</title>

    <!-- Google Fonts (Bebas Neue & Google Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Google Sans', sans-serif;
        }

        /* Hero Header Styling */
        .hero-header {
            min-height: 100vh;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.5) 0%,
                rgba(0, 0, 0, 0.7) 100%
            ), url("{{ asset('images/hero-sekolah.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            position: relative;
        }

        .navbar-custom {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        /* Styling Garis Biru Navigasi */
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            position: relative;
            padding-bottom: 6px;
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff !important;
        }

        .navbar-custom .nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
        }

        .navbar-custom .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        .btn-purple {
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 8px;
            padding: 8px 20px;
        }
        .btn-purple:hover {
            background-color: #2563eb;
            color: #ffffff;
        }

        .font-bebas {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>

    <!-- Hero Header -->
    <header class="hero-header d-flex flex-column justify-content-between">
        
        <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4 Bogor" height="40">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Navigasi Presisi di Tengah -->
            <ul class="navbar-nav position-absolute start-50 translate-middle-x">
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ request()->is('/') ? 'active' : '' }}" href="#Beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ request()->is('berita*') ? 'active' : '' }}" href="#Berita">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ request()->is('jurusan*') ? 'active' : '' }}" href="#jurusan">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{ request()->is('galeri*') ? 'active' : '' }}" href="#galeri">Galeri</a>
                </li>
            </ul>

            <!-- Tombol Masuk Terkunci di Ujung Kanan (Ditambahkan ms-auto) -->
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-purple border-0 fw-semibold">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-purple border-0 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

        <!-- Teks Hero Tengah -->
        <div class="container my-auto pt-5 mt-5 text-center" style="transform: translateY(100px);">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="fs-3 fw-light mb-2">Selamat Datang di Website</p>
                    <h1 class="fw-bold mb-3" style="font-family: 'Bebas Neue', sans-serif; font-size: 190px; line-height: 1;">
                        SMK NEGERI 4<br>Kota Bogor
                    </h1>
                    <p class="lead mb-4 text-light col-md-8 mx-auto">
                        Mencetak generasi unggul dalam teknologi, berkarakter, dan siap bersaing di Masa Depan.
                    </p>
                    <a href="#tentang" class="btn btn-purple btn-lg fw-semibold px-4 py-2">
                        Tentang Sekolah <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Arrow Down -->
        <div class="text-center pb-4">
            <a href="#tentang" class="text-white opacity-75 fs-3">
                <i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
    </header>

    <!-- Section Tentang -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container text-center py-5">
            <h2 class="fw-bold mb-3">Tentang SMKN 4 Kota Bogor</h2>
            <p class="text-muted col-md-8 mx-auto">
                Informasi profil singkat mengenai sekolah, visi misi, serta program keahlian yang tersedia.
            </p>
        </div>
    </section>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>