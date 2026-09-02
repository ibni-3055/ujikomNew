<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SMKN 4 Kota Bogor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<section class="vh-100" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/background.avif') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card shadow-lg" style="border-radius: 1rem; overflow: hidden;">
          <div class="row g-0">
            <!-- Gambar Samping Kiri -->
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('images/hero-sekolah.jpg') }}"
                alt="login form" class="img-fluid h-100" style="object-fit: cover;" />
            </div>
            
            <!-- Form Login Kanan -->
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <!-- Form POST Laravel Login -->
                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <!-- Logo & Nama Sekolah -->
                  <div class="d-flex align-items-center mb-3 pb-1 gap-2">
                    <img src="{{ asset('images/logo-smkn4.svg') }}" alt="Logo SMKN 4 Bogor" height="40">
                    <span class="h3 fw-bold mb-0">Portal Akademik</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Masuk ke Akun Admin</h5>

                  <!-- Status Sesi (Misal: setelah reset password) -->
                  @if (session('status'))
                      <div class="alert alert-success mb-3" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  <!-- Input Email -->
                  <div class="form-outline mb-3">
                    <label class="form-label fw-semibold" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                      class="form-control form-control-lg @error('email') is-invalid @enderror" required autofocus />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Input Password -->
                  <div class="form-outline mb-3">
                    <label class="form-label fw-semibold" for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" 
                      class="form-control form-control-lg @error('password') is-invalid @enderror" required />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Remember Me (Opsional) -->
                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label text-muted" for="remember_me">Ingat saya</label>
                  </div>

                  <!-- Tombol Submit Login -->
                  <div class="pt-1 mb-4 d-grid">
                    <button class="btn btn-primary btn-lg fw-semibold" type="submit">Masuk</button>
                  </div>

                  <!-- Link Lupa Password & Kembali -->
                  @if (Route::has('password.request'))
                    <a class="small text-muted" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                  @endif
                  
                  <div class="mt-3">
                    <a href="{{ url('/') }}" class="small text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>