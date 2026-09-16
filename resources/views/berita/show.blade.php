<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - SMKN 4 Kota Bogor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
    body {
        font-family: 'Google Sans', sans-serif;
        background-color: #f8fafc;
        color: #334155;
    }

    /* Mengatur jarak baris dan antar paragraf agar lebih rapat & rapi */
    .article-content {
        font-size: 1.05rem;
        line-height: 1.6; /* Diturunkan dari 1.8 agar teks lebih rapat */
        color: #334155;
        white-space: pre-line;
    }

    /* Menjaga jarak antar paragraf tidak terlalu jauh */
    .article-content p {
        margin-bottom: 0.85rem; 
    }
</style>
</head>
<body>

    <!-- Navbar Sederhana -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4" height="40" onerror="this.src='https://placehold.co/40'">
                <span class="fw-bold text-dark fs-5">SMKN 4 KOTA BOGOR</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Detail Berita -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    
                    <!-- Header Berita -->
                    <div class="mb-4 text-center">
                        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-3">
                            <i class="bi bi-newspaper me-1"></i> Berita Sekolah
                        </span>
                        <h1 class="fw-bold text-dark display-6 mb-3">{{ $berita->judul }}</h1>
                        <div class="text-muted small d-flex justify-content-center align-items-center gap-3">
                            <span><i class="bi bi-calendar3 me-1"></i> {{ isset($berita->tanggal_upload) ? \Carbon\Carbon::parse($berita->tanggal_upload)->format('d F Y') : $berita->created_at->format('d F Y') }}</span>
                            <span>•</span>
                            <span><i class="bi bi-person me-1"></i> Admin SMKN 4</span>
                        </div>
                    </div>

                    <!-- Gambar Utama -->
@php
    $fotoPath = $berita->foto ?? $berita->gambar ?? $berita->image ?? null;
@endphp
<div class="overflow-hidden rounded-4 shadow-sm mb-5 bg-light d-flex align-items-center justify-content-center">
    @if($fotoPath)
        <img src="{{ asset('storage/' . $fotoPath) }}" alt="{{ $berita->judul }}" class="img-fluid w-100 rounded-4" style="height: auto; max-height: 600px; object-fit: contain;">
    @else
        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="{{ $berita->judul }}" class="img-fluid w-100 rounded-4" style="height: auto; max-height: 600px; object-fit: contain;">
    @endif
</div>

                    <!-- Isi Berita -->
<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-5">
    <div class="article-content">
        {!! e($berita->deskripsi ?? $berita->isi ?? $berita->ringkasan) !!}
    </div>
</div>

                    <!-- Navigation Footer -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ url('/#Berita') }}" class="btn btn-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>

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