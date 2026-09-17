@extends('layouts.app')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-newspaper fs-6"></i> Informasi & Publikasi
        </span>
        <h3 class="fw-bold text-dark mb-1">Pengelolaan Berita Sekolah</h3>
        <p class="text-muted small mb-0">Unggah berita terbaru, perbarui konten, atau hapus berita publikasi.</p>
    </div>
    <button class="btn btn-dark d-lg-none shadow-sm" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
</div>

<div class="row g-4">
    <!-- Form Upload Berita -->
    <div class="col-lg-4">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 bg-success bg-opacity-10 border-bottom border-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-cloud-upload-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Upload Berita Baru</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Isi formulir untuk menambahkan berita</small>
                    </div>
                </div>
            </div>

            <div class="p-4">
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

                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Judul Berita</label>
                        <input type="text" name="judul" class="form-control bg-light rounded-3" placeholder="Masukkan judul berita..." value="{{ old('judul') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Deskripsi / Isi Berita</label>
                        <textarea name="deskripsi" class="form-control bg-light rounded-3" rows="4" placeholder="Tuliskan ringkasan / isi berita..." required>{{ old('deskripsi') }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Foto Header</label>
                        <input type="file" name="foto" class="form-control bg-light rounded-3" accept="image/*">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Tanggal Upload</label>
                        <input type="datetime-local" name="tanggal_upload" class="form-control bg-light rounded-3" value="{{ old('tanggal_upload', date('Y-m-d\TH:i')) }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-send-fill me-1"></i> Terbitkan Berita
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Berita Terbit -->
    <div class="col-lg-8">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-collection-play-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Daftar Berita Published</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Artikel dan berita yang sedang tampil publik</small>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <div class="row g-3">
                    @forelse($berita ?? $beritas ?? [] as $b)
                        @php
                            $gambarPath = $b->foto ?? $b->gambar ?? $b->image ?? null;
                        @endphp
                        <div class="col-md-6">
                            <div class="card border rounded-4 overflow-hidden h-100 shadow-sm hover-shadow transition-all bg-white">
                                @if($gambarPath)
                                    <img src="{{ asset('storage/' . $gambarPath) }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $b->judul }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 160px;">
                                        <i class="bi bi-image fs-1 opacity-50"></i>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="fw-bold text-dark mb-1">{{ $b->judul }}</h6>
                                    <p class="small text-muted mb-2" style="font-size: 0.75rem;">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ isset($b->tanggal_upload) ? \Carbon\Carbon::parse($b->tanggal_upload)->format('d M Y - H:i') : $b->created_at->format('d M Y') }}
                                    </p>
                                    <p class="card-text text-secondary small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 0.825rem;">
                                        {{ $b->deskripsi ?? $b->isi ?? $b->ringkasan }}
                                    </p>

                                    <div class="d-flex gap-2 mt-auto">
                                        <!-- Tombol Edit Modal Trigger -->
                                        <button class="btn btn-warning btn-sm text-white rounded-3 w-100 fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#editBeritaModal{{ $b->id }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>

                                        <!-- Form Hapus -->
                                        <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" class="w-100" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-3">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit Berita -->
                        <div class="modal fade" id="editBeritaModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                    <form action="{{ route('admin.berita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-header bg-dark text-white p-4 border-0">
                                            <h5 class="modal-title fw-bold fs-6">Edit Berita</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        
                                        <div class="modal-body p-4 text-start">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Judul Berita</label>
                                                <input type="text" name="judul" class="form-control bg-light rounded-3" value="{{ $b->judul }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Deskripsi / Isi Berita</label>
                                                <textarea name="deskripsi" class="form-control bg-light rounded-3" rows="4" required>{{ $b->deskripsi ?? $b->isi }}</textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-semibold text-muted">Ganti Foto <span class="fw-normal text-muted">(Biarkan kosong jika tidak diganti)</span></label>
                                                <input type="file" name="foto" class="form-control bg-light rounded-3" accept="image/*">
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
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                                <i class="bi bi-newspaper fs-1 text-secondary opacity-50"></i>
                            </div>
                            <p class="mb-0 fw-medium">Belum ada berita yang diterbitkan.</p>
                            <small class="text-muted">Gunakan form di samping untuk mengunggah berita pertama.</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection