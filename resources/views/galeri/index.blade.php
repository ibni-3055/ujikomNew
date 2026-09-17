@extends('layouts.app')

@section('content')
<!-- Header Page -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-slate-900 mb-1">Galeri Sekolah</h3>
        <p class="text-muted small mb-0">Tambah, perbarui, atau hapus foto fasilitas dan kegiatan sekolah.</p>
    </div>
    <button class="btn btn-dark d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
</div>

<div class="row g-4">
    <!-- Form Upload Galeri Baru (CREATE) -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 bg-white border-0 shadow-sm rounded-4">
            <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-cloud-upload-fill text-warning"></i> Tambah Foto Tempat
            </h5>

            @if(session('success'))
                <div class="alert alert-success rounded-3 small border-0 shadow-sm mb-3">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
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

            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_tempat" class="form-label small fw-semibold text-muted">Nama Tempat / Judul Foto</label>
                    <input type="text" name="nama_tempat" id="nama_tempat" class="form-control bg-light rounded-3" placeholder="Contoh: Lab Komputer" value="{{ old('nama_tempat') }}" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label small fw-semibold text-muted">File Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control bg-light rounded-3" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-3 fw-semibold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-upload"></i> Unggah Foto
                </button>
            </form>
        </div>
    </div>

    <!-- List Foto Galeri -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 bg-white border-0 shadow-sm rounded-4">
            <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-images text-primary"></i> Daftar Galeri Ter-upload
            </h5>
            
            <div class="row g-3">
                @forelse($galeris ?? $galeri ?? [] as $g)
                    <div class="col-md-6">
                        <div class="card border rounded-4 overflow-hidden h-100 shadow-sm transition-all bg-white">
                            <img src="{{ asset('storage/' . $g->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $g->nama_tempat }}">
                            
                            <div class="card-body d-flex justify-content-between align-items-center bg-white p-3">
                                <h6 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 160px;">{{ $g->nama_tempat }}</h6>
                                
                                <div class="d-flex gap-1">
                                    <!-- Tombol Edit Modal -->
                                    <button class="btn btn-outline-warning btn-sm border-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#editGaleriModal{{ $g->id }}" title="Edit">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </button>

                                    <!-- Form Hapus Galeri -->
                                    <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 rounded-circle" title="Hapus">
                                            <i class="bi bi-trash fs-6"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Galeri (UPDATE) -->
                    <div class="modal fade" id="editGaleriModal{{ $g->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
                                <form action="{{ route('admin.galeri.update', $g->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="modal-header border-bottom-0 pb-0">
                                        <h5 class="modal-title fw-bold fs-6">Edit Foto Galeri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    
                                    <div class="modal-body py-3 text-start">
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-muted">Nama Tempat / Lokasi</label>
                                            <input type="text" name="nama_tempat" class="form-control bg-light rounded-3" value="{{ $g->nama_tempat }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-muted">Ganti Foto <span class="text-muted fw-normal">(Kosongkan jika tidak diubah)</span></label>
                                            <input type="file" name="foto" class="form-control bg-light rounded-3" accept="image/*">
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer border-top-0 pt-0">
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
                            <i class="bi bi-images fs-1 text-secondary opacity-50"></i>
                        </div>
                        <p class="mb-0 fw-medium">Belum ada foto galeri yang diunggah.</p>
                        <small class="text-muted">Gunakan form di samping untuk mengunggah foto pertama.</small>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection