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

    <!-- Panggil file CSS Vite -->
    @vite(['resources/css/app.css'])
</head>
<body>

    <!-- Hero Header -->
    <header id="Beranda" class="hero-header d-flex flex-column justify-content-between position-relative" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.7) 100%), url('{{ asset('images/hero-sekolah.jpg') }}'); min-height: 100vh; background-size: cover; background-position: center;">
        
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        
        <!-- Logo di Kiri -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4 Bogor" height="40">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Container Menu & Tombol -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Utama Presisi di Tengah Layar -->
            <ul class="navbar-nav position-absolute start-50 translate-middle-x d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ request()->is('/') ? 'active' : '' }}" href="#Beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ request()->is('berita*') ? 'active' : '' }}" href="{{ url('/berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ request()->is('jurusan*') ? 'active' : '' }}" href="{{ url('/jurusan') }}">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ url('/galeri') }}">Galeri</a>
                </li>
            </ul>

            <!-- Menu untuk Tampilan Mobile/HP -->
            <ul class="navbar-nav d-lg-none my-2">
                <li class="nav-item"><a class="nav-link" href="#Beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/berita') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/jurusan') }}">Jurusan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/galeri') }}">Galeri</a></li>
            </ul>

            <!-- Tombol Masuk/Dashboard di Kanan -->
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-purple border-0 fw-semibold">
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
        <div class="container my-auto pt-5 text-center" style="transform: translateY(5px);">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="fs-3 fw-light mb-2 text-white">Selamat Datang di Website</p>
                    <h1 class="fw-bold mb-3 text-white" style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(60px, 12vw, 190px); line-height: 1;">
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

    </header>

    <!-- Section Tentang -->
    <section id="tentang" class="py-5 bg-light position-relative">
        <div class="container py-4">
            <!-- Judul Utama -->
            <h2 class="text-center fw-bold mb-5" style="letter-spacing: 1px; color: #1e1b4b;">TENTANG SEKOLAH</h2>

            <!-- Card Utama Putih -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <div class="row g-4 align-items-center">
                    
                    <!-- Kolom Kiri: Gambar & Badge -->
                    <div class="col-lg-5">
                        <div class="position-relative">
                            <!-- Foto Sekolah -->
                            <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Gedung SMKN 4 Bogor" class="img-fluid rounded-4 w-100 object-fit-cover" style="height: 420px;">
                            
                            <!-- Badge Ungu Kecil di Bawah Gambar -->
                            <div class="position-absolute bottom-0 start-0 m-3 p-3 text-white rounded-3 d-flex align-items-center gap-3 shadow" style="background-color: #2414A2; max-width: 90%;">
                                <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                    <i class="bi bi-journal-bookmark-fill fs-5"></i>
                                </div>
                                <p class="mb-0 small leading-tight">
                                    <strong>SMK Negeri 4 Kota Bogor</strong> berkomitmen membentuk generasi unggul yang berkompeten di bidangnya dan berdaya saing global.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Teks, Visi, & Misi -->
                    <div class="col-lg-7">
                        <span class="text-danger fw-semibold text-uppercase small">Tentang Sekolah</span>
                        <h3 class="fw-bold mb-3 mt-1" style="color: #2414A2;">
                            Membentuk Generasi Unggul,<br>Berkarakter dan Berprestasi
                        </h3>
                        <p class="text-muted small mb-4" style="font-family: 'Google Sans', sans-serif; font-weight: 500;">
                            SMK Negeri 4 Kota Bogor merupakan sekolah menengah kejuruan yang berfokus pada pengembangan kompetensi siswa di bidang teknologi dan industri. Kami berkomitmen memberikan pendidikan berkualitas, berbasis karakter, serta relevan dengan kebutuhan dunia kerja dan perkembangan zaman.
                        </p>

                        <!-- Kotak Visi & Misi (2 Kolom) -->
                        <div class="row g-3">
                            <!-- Kotak Visi -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100 border border-0">
                                    <h5 class="fw-bold d-flex align-items-center gap-2" style="color: #2414A2;">
                                        <i class="bi bi-bullseye text-primary"></i> VISI
                                    </h5>
                                    <p class="text-muted small mb-0" style="font-family: 'Google Sans', sans-serif; font-weight: 500;">
                                        Menjadi sekolah menengah kejuruan unggulan yang menghasilkan lulusan berkompeten, berkarakter, dan berdaya saing global.
                                    </p>
                                </div>
                            </div>

                            <!-- Kotak Misi -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100 border border-0">
                                    <h5 class="fw-bold d-flex align-items-center gap-2" style="color: #2414A2;">
                                        <i class="bi bi-compass text-primary"></i> MISI
                                    </h5>
                                    <ul class="text-muted small mb-0 ps-3" style="font-family: 'Google Sans', sans-serif; font-weight: 500;">
                                        <li>Menyelenggarakan pendidikan yang berkualitas</li>
                                        <li>Mengembangkan kompetensi siswa sesuai dunia kerja</li>
                                        <li>Menanamkan nilai-nilai karakter dan budaya industri</li>
                                        <li>Membangun kemitraan dengan dunia usaha dan industri</li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- End Row Visi Misi -->

                    </div> <!-- End Kolom Kanan -->

                </div>
            </div> <!-- End Card Utama -->

        </div>
    </section>

    <!-- Section Berita Sekolah -->
<section id="Berita" class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Judul Section -->
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="font-family: 'Google Sans', sans-serif; font-weight: 500; color: #1e1b4b;">BERITA SEKOLAH</h2>
            <p style="font-family: 'Google Sans', sans-serif; font-weight: 300;">
                Dapatkan informasi terbaru seputar kegiatan, prestasi, dan pengumuman resmi dari SMK Negeri 4 Kota Bogor.
            </p>
        </div>

        <!-- Grid Cards -->
        <div class="row g-4 justify-content-center">
            
            @forelse ($beritas as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                        
                        <!-- Area Gambar Berita -->
                        <div class="overflow-hidden rounded-3 mb-3" style="height: 200px;">
                            @php
                                // Pengecekan field gambar/foto dari database
                                $fotoPath = $item->foto ?? $item->gambar ?? $item->image ?? null;
                            @endphp

                            @if($fotoPath)
                                <img src="{{ asset('storage/' . $fotoPath) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            @else
                                <img src="{{ asset('images/hero-sekolah.jpg') }}" 
                                     alt="{{ $item->judul }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            @endif
                        </div>
                        
                        <!-- Body Card -->
                        <div class="card-body p-0 d-flex flex-column">
                            <h5 class="fw-bold text-dark mb-2">{{ $item->judul }}</h5>
                            
                            <p class="text-muted small mb-3 flex-grow-1" style="line-height: 1.6;">
                                {{ Str::limit(strip_tags($item->isi ?? $item->ringkasan ?? $item->deskripsi), 120) }}
                            </p>

                            <span class="text-secondary small mb-3" style="font-size: 0.8rem;">
                                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('d F Y') }}
                            </span>

                            <div>
                                <a href="{{ url('/berita/' . ($item->slug ?? $item->id)) }}" class="text-primary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2">
                                    Baca selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <!-- Tampilan Jika Belum Ada Berita di Database -->
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-newspaper fs-1 d-block mb-2 text-secondary"></i>
                    <p class="mb-0">Belum ada berita terbaru yang diunggah.</p>
                </div>
            @endforelse

        </div> <!-- End Row -->

        <!-- Tombol Selengkapnya -->
        @if(isset($beritas) && $beritas->isNotEmpty())
            <div class="text-center mt-5">
                <a href="{{ url('/berita') }}" class="btn btn-purple btn-lg fw-semibold px-4 py-2 shadow-sm">
                    Lihat Semua Berita <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </div>
        @endif

    </div>
</section>

    <!-- Section Jurusan / Program Keahlian -->
    <section id="jurusan" class="py-5 bg-light">
        <div class="container py-4">
            
            <!-- Judul Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase" style="letter-spacing: 1px; color: #1e1b4b;">PROGRAM KEAHLIAN</h2>
                <p style="font-family: 'Google Sans', sans-serif; font-weight: 300;">
                    Pilihan jurusan unggulan yang dirancang untuk membekali siswa dengan keahlian praktis sesuai kebutuhan industri modern.
                </p>
            </div>

            <!-- Grid Jurusan (4 Kotak) -->
            <div class="row g-4">
                
                <!-- Jurusan 1: PPLG -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                        <div class="rounded-circle bg-primary-subtle text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-code-slash fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">PPLG</h5>
                        <p class="text-secondary small fw-semibold mb-2">Pengembangan Perangkat Lunak & Gim</p>
                        <p class="text-muted small mb-0">
                            Fokus pada pemrograman web, aplikasi mobile, pembuatan gim, dan pengelolaan database modern.
                        </p>
                    </div>
                </div>

                <!-- Jurusan 2: TJKT -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                        <div class="rounded-circle bg-success-subtle text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-diagram-3 fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">TJKT</h5>
                        <p class="text-secondary small fw-semibold mb-2">Teknik Jaringan Komputer & Telekomunikasi</p>
                        <p class="text-muted small mb-0">
                            Mempelajari infrastruktur jaringan, server, keamanan siber (cyber security), dan teknologi fiber optik.
                        </p>
                    </div>
                </div>

                <!-- Jurusan 3: TO -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                        <div class="rounded-circle bg-warning-subtle text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-gear-wide-connected fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">TO</h5>
                        <p class="text-secondary small fw-semibold mb-2">Teknik Otomotif</p>
                        <p class="text-muted small mb-0">
                            Pendalaman seputar pemeliharaan mesin kendaraan, sistem kelistrikan otomotif, dan teknologi kendaraan terkini.
                        </p>
                    </div>
                </div>

                <!-- Jurusan 4: TP -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                        <div class="rounded-circle bg-danger-subtle text-danger mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-tools fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">TP</h5>
                        <p class="text-secondary small fw-semibold mb-2">Teknik Pengelasan</p>
                        <p class="text-muted small mb-0">
                            Menguasai teknik penyambungan logam, fabrikasi struktur baja, dan standar fabrikasi industri.
                        </p>
                    </div>
                </div>

            </div> <!-- End Row -->

        </div>
    </section>

    <!-- Section Galeri Sekolah -->
<section id="galeri" class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Judul Section -->
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="font-family: 'Google Sans', sans-serif; font-weight: 500; color: #1e1b4b;">GALERI SEKOLAH</h2>
            <p style="font-family: 'Google Sans', sans-serif; font-weight: 300;">
                Dokumentasi kegiatan, fasilitas, dan momen berharga di lingkungan SMK Negeri 4 Kota Bogor.
            </p>
        </div>

        <!-- Grid Galeri (3 Kolom) -->
        <div class="row g-4 justify-content-center">
            
            @forelse ($galeris as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="height: 260px;">
                        
                        @php
                            // Ambil foto & teks dari database
                            $fotoPath = $item->foto ?? $item->gambar ?? $item->image ?? null;
                            $namaFoto = $item->judul ?? $item->nama ?? $item->keterangan ?? 'Kegiatan Sekolah';
                        @endphp

                        <!-- Gambar Galeri -->
                        @if($fotoPath)
                            <img src="{{ asset('storage/' . $fotoPath) }}" 
                                 alt="{{ $namaFoto }}" 
                                 class="w-100 h-100 object-fit-cover">
                        @else
                            <img src="{{ asset('images/hero-sekolah.jpg') }}" 
                                 alt="{{ $namaFoto }}" 
                                 class="w-100 h-100 object-fit-cover">
                        @endif

                        <!-- Nama/Judul Foto Overlap di Atas Gambar -->
<div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex flex-column justify-content-end" 
     style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 100%); height: 60%;">
    
    <!-- Ambil nama_tempat dari database -->
    <h5 class="text-white fw-bold mb-1 fs-6 text-truncate" title="{{ $item->nama_tempat ?? $item->judul }}">
        {{ $item->nama_tempat ?? $item->judul ?? 'Dokumentasi Sekolah' }}
    </h5>

    @if(isset($item->created_at))
        <span class="text-white-50 small" style="font-size: 0.75rem;">
            <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('d M Y') }}
        </span>
    @endif
</div>

                    </div>
                </div>
            @empty
                <!-- Tampilan Jika Belum Ada Foto -->
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2 text-secondary"></i>
                    <p class="mb-0">Belum ada foto galeri yang diunggah.</p>
                </div>
            @endforelse

        </div> <!-- End Row -->

        <!-- Tombol Lihat Selengkapnya -->
        @if(isset($galeris) && $galeris->isNotEmpty())
            <div class="text-center mt-5">
                <a href="{{ url('/galeri') }}" class="btn btn-purple btn-lg fw-semibold px-4 py-2 shadow-sm">
                    Lihat Selengkapnya <i class="bi bi-chevron-right ms-1"></i>
                </a>
            </div>
        @endif

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
                    <div class="d-flex gap-3 mt-3 justify-content-center justify-content-md-start">
                        <a href="https://www.facebook.com/smknegeri4bogor/?locale=id_ID" target="_blank" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" target="_blank" class="text-white bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 38px; height: 38px;">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-primary">Navigasi</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="#Beranda" class="text-secondary text-decoration-none">Beranda</a></li>
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
                        <li><span class="text-secondary">TJKT (Teknik Jaringan Komputer)</span></li>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>