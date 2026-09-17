@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1 rounded-pill">
                    Kelas {{ $kelas->nama_kelas }}
                </span>
                <span class="text-muted small">• {{ $kelas->murids->count() }} Murid Terdaftar</span>
            </div>
            <h4 class="fw-bold text-dark mb-0">Manajemen Siswa</h4>
        </div>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-light border text-secondary fw-medium rounded-3 px-3 py-2 btn-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center gap-2 mb-4 py-2 px-3" role="alert">
            <i class="bi bi-check-circle-fill fs-5 text-success"></i>
            <span class="small fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto small" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert Errors -->
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-6"></i>
                <span class="fw-bold small">Terdapat kesalahan pada masukan data:</span>
            </div>
            <ul class="mb-0 ps-4 small text-secondary">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <!-- Sidebar: Form Tambah Murid -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h6 class="fw-bold mb-0 text-dark">Tambah Murid Baru</h6>
                    </div>
                    <p class="text-muted small mb-4">Masukkan data kredensial siswa untuk didaftarkan ke kelas ini.</p>

                    <form action="{{ route('admin.murid.store', $kelas->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary mb-1">NISN</label>
                            <input type="text" name="nisn" class="form-control form-control-sm rounded-3 bg-light border-0 px-3 py-2" placeholder="Nomor NISN" value="{{ old('nisn') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary mb-1">NIS</label>
                            <input type="text" name="nis" class="form-control form-control-sm rounded-3 bg-light border-0 px-3 py-2" placeholder="Nomor NIS" value="{{ old('nis') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-sm rounded-3 bg-light border-0 px-3 py-2" placeholder="Nama lengkap siswa" value="{{ old('nama') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-medium rounded-3 py-2 shadow-sm border-0 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-plus-lg"></i> Simpan Murid
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content: Tabel Daftar Murid -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <!-- Table Header Controls -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-3">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Daftar Siswa</h6>
                            <span class="text-muted small">Total {{ $kelas->murids->count() }} siswa di {{ $kelas->nama_kelas }}</span>
                        </div>

                        <!-- Real-time Search Input -->
                        <div class="position-relative" style="max-width: 240px; width: 100%;">
                            <input type="text" id="searchMurid" class="form-control form-control-sm bg-light border-0 rounded-3 ps-4 py-2" placeholder="Cari NISN, NIS, nama...">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted small"></i>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0" id="tableMurid">
                            <thead>
                                <tr class="border-bottom text-muted small">
                                    <th class="fw-semibold pb-3" style="width: 25%;">NISN / NIS</th>
                                    <th class="fw-semibold pb-3" style="width: 60%;">NAMA MURID</th>
                                    <th class="fw-semibold pb-3 text-end" style="width: 15%;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas->murids as $m)
                                <tr class="border-bottom-subtle">
                                    <td class="py-3">
                                        <div class="fw-semibold text-dark small mb-0">{{ $m->nisn }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">NIS: {{ $m->nis }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 34px; height: 34px; font-size: 0.85rem;">
                                                {{ strtoupper(substr($m->nama, 0, 1)) }}
                                            </div>
                                            <span class="fw-medium text-dark small">{{ $m->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-end">
                                        <form action="{{ route('admin.murid.destroy', $m->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none opacity-75 opacity-100-hover" title="Hapus" onclick="return confirm('Hapus {{ $m->nama }}?')">
                                                <i class="bi bi-trash3 fs-6"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <div class="mb-2">
                                            <i class="bi bi-people text-secondary opacity-50 fs-2"></i>
                                        </div>
                                        <p class="small fw-medium mb-1">Belum ada siswa di kelas ini</p>
                                        <span class="text-muted extra-small">Gunakan formulir di sebelah kiri untuk menambahkan siswa baru.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter Script -->
<script>
    document.getElementById('searchMurid')?.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableMurid tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>

<style>
    /* Styling Tambahan Minimalis */
    .extra-small {
        font-size: 0.75rem;
    }
    .border-bottom-subtle {
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
    }
    .border-bottom-subtle:last-child {
        border-bottom: none;
    }
    .opacity-100-hover:hover {
        opacity: 1 !important;
    }
</style>
@endsection