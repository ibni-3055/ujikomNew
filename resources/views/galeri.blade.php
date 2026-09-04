<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri & Fasilitas - SMK Negeri 4 Kota Bogor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css'])
</head>
<body class="bg-light">

    <!-- Navbar Utama (Sesuai Komponen Kamu) -->
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
                        <a class="nav-link mx-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}#Beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 {{ request()->is('berita*') ? 'active' : '' }}" href="{{ url('/') }}#Berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 {{ request()->is('jurusan*') ? 'active' : '' }}" href="{{ url('/jurusan') }}">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ url('/galeri') }}">Galeri</a>
                    </li>
                </ul>

                <!-- Tombol Masuk Terkunci di Ujung Kanan -->
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

    <!-- Header Galeri -->
    <section class="pt-5 mt-5 pb-4 bg-white border-bottom">
        <div class="container pt-4 text-center">
            <h1 class="fw-bold text-uppercase" style="letter-spacing: 1px; color: #1e1b4b;">GALERI & FASILITAS SEKOLAH</h1>
            <p class="text-muted col-md-8 mx-auto small">
                Kumpulan dokumentasi kegiatan, fasilitas pembelajaran, serta momen-momen penting di lingkungan SMK Negeri 4 Kota Bogor.
            </p>
        </div>
    </section>

    <!-- Grid Foto Galeri Penuh -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                
                <!-- Item Galeri 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Taman Sekolah" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Taman Sekolah</h5>
                        </div>
                    </div>
                </div>

                <!-- Item Galeri 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Laboratorium Komputer" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Laboratorium Komputer PPLG</h5>
                        </div>
                    </div>
                </div>

                <!-- Item Galeri 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Bengkel Otomotif" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Bengkel Teknik Otomotif</h5>
                        </div>
                    </div>
                </div>

                <!-- Item Galeri 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lapangan Olahraga" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Lapangan Olahraga</h5>
                        </div>
                    </div>
                </div>

                <!-- Item Galeri 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Perpustakaan" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Perpustakaan Digital</h5>
                        </div>
                    </div>
                </div>

                <!-- Item Galeri 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-white" style="height: 250px;">
                        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Ruang Ekstrakurikuler" class="w-100 h-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); height: 50%;">
                            <h5 class="text-white fw-bold mb-0">Kegiatan Ekstrakurikuler</h5>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-3">
        <div class="container text-center text-md-start">
            <div class="row g-4">

                <!-- Kolom 1: Profil Sekolah & Logo -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4 Bogor" height="45">
                        <h5 class="fw-bold text-white mb-0">SMKN 4 KOTA BOGOR</h5>
                    </div>
                    <p class="text-secondary small leading-relaxed">
                        Mencetak generasi unggul dalam teknologi, berkarakter, dan siap bersaing di masa depan melalui pendidikan kejuruan yang berkualitas.
                    </p>
                    <!-- Sosmed Icons -->
                    <div class="d-flex gap-3 mt-3">
                        <a href="https://www.facebook.com/smknegeri4bogor/?locale=id_ID" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Navigasi</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ url('/') }}#Beranda" class="text-secondary text-decoration-none">Beranda</a></li>
                        <li><a href="#tentang" class="text-secondary text-decoration-none">Tentang Sekolah</a></li>
                        <li><a href="#Berita" class="text-secondary text-decoration-none">Berita Sekolah</a></li>
                        <li><a href="#jurusan" class="text-secondary text-decoration-none">Program Keahlian</a></li>
                        <li><a href="#galeri" class="text-secondary text-decoration-none">Galeri</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Jurusan -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Jurusan</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><span class="text-secondary">PPLG (Pengembangan Perangkat Lunak)</span></li>
                        <li><span class="text-secondary">TKT (Teknik Jaringan Komputer)</span></li>
                        <li><span class="text-secondary">TO (Teknik Otomotif)</span></li>
                        <li><span class="text-secondary">TP (Teknik Pengelasan)</span></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak Sekolah -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Kontak Kami</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-3 text-secondary">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt-fill text-primary"></i>
                            <span>Jl. Raya Tajur, Kp. Muara, RT.03/RW.04, Sindangrasa, Bogor Timur, Kota Bogor</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center">
                            <i class="bi bi-telephone-fill text-primary"></i>
                            <span>(0251) 8242411</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center">
                            <i class="bi bi-envelope-fill text-primary"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="border-secondary my-4 opacity-25">

            <!-- Bottom Copyright -->
            <div class="row align-items-center small text-secondary">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    &copy; {{ date('Y') }} SMKN 4 Kota Bogor. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span>Dikembangkan oleh <strong class="text-white">Tim SMKN 4 Bogor</strong></span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>