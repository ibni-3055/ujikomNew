@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Kelas {{ $kelas->nama_kelas }}</h3>
        <p class="text-muted mb-0">Tambah dan hapus daftar murid di kelas ini.</p>
    </div>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <!-- Form Tambah Murid -->
    <div class="col-lg-4">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-person-plus-fill text-success me-2"></i>Tambah Murid</h5>
            <form action="{{ route('admin.murid.store', $kelas->id) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="form-label small fw-semibold">NISN</label>
                    <input type="text" name="nisn" class="form-control" placeholder="Nomor NISN" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">NIS</label>
                    <input type="text" name="nis" class="form-control" placeholder="Nomor NIS" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Murid" required>
                </div>
                <button type="submit" class="btn btn-success w-100 fw-semibold">
                    <i class="bi bi-check-circle-fill me-1"></i> Tambah Murid
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Data Murid -->
    <div class="col-lg-8">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-people-fill text-primary me-2"></i>Daftar Siswa {{ $kelas->nama_kelas }}</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama Murid</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas->murids as $m)
                        <tr>
                            <td class="fw-medium">{{ $m->nisn }}</td>
                            <td>{{ $m->nis }}</td>
                            <td class="fw-semibold text-dark">{{ $m->nama }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.murid.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus siswa ini?')">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada siswa di kelas ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection