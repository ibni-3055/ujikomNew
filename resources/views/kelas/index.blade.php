@extends('layouts.app')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-door-closed-fill fs-6"></i> Data Akademik
        </span>
        <h3 class="fw-bold text-dark mb-1">Pengelolaan Data Kelas</h3>
        <p class="text-muted small mb-0">Atur daftar kelas dan akses manajemen siswa di setiap kelas.</p>
    </div>
    <button class="btn btn-dark d-lg-none shadow-sm" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
</div>

<div class="row g-4">
    <!-- Form Tambah Kelas Dropdown (Di Atas) -->
    <div class="col-12">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 bg-primary bg-opacity-10 border-bottom border-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Tambah Kelas Baru</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Pilih tingkat, jurusan, dan nomor kelas</small>
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

                <form action="{{ route('admin.kelas.store') }}" method="POST" id="formTambahKelas">
                    @csrf
                    <!-- Hidden Input untuk menampung gabungan nama kelas -->
                    <input type="hidden" name="nama_kelas" id="nama_kelas_input">

                    <div class="row g-3 align-items-end">
                        <!-- Dropdown Tingkat Kelas -->
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">Tingkat Kelas</label>
                            <select id="select_tingkat" class="form-select bg-light rounded-3" required>
                                <option value="" disabled selected>-- Pilih Tingkat --</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>

                        <!-- Dropdown Jurusan -->
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-secondary">Jurusan</label>
                            <select id="select_jurusan" class="form-select bg-light rounded-3" required>
                                <option value="" disabled selected>-- Pilih Jurusan --</option>
                                <option value="Teknik Otomotif">Teknik Otomotif</option>
                                <option value="Teknik Pengelasan">Teknik Pengelasan</option>
                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                <option value="Pemrograman Perangkat Lunak dan Gim">Pemrograman Perangkat Lunak dan Gim</option>
                            </select>
                        </div>

                        <!-- Dropdown Nomor Jurusan -->
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">Nomor Kelas</label>
                            <select id="select_nomor" class="form-select bg-light rounded-3" required>
                                <option value="" disabled selected>-- Pilih No --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-check-circle me-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- List Daftar Kelas (Di Bawah) -->
    <div class="col-12">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-dark text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-list-task fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Daftar Kelas Terdaftar</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Total kelas aktif yang ada di sistem</small>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="list-group list-group-flush">
                    @forelse($kelases ?? $kelas ?? [] as $k)
                        <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-3 mb-2 rounded-3 border bg-light bg-opacity-50 hover-shadow transition-all gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-door-closed-fill fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">{{ $k->nama_kelas }}</h6>
                                    <!-- Bagian ID Kelas diganti dengan Jumlah Siswa/Murid -->
                                    <span class="text-muted small d-flex align-items-center gap-1" style="font-size: 0.75rem;">
    <i class="bi bi-people"></i> 
    {{ $k->murids_count ?? 0 }} Siswa
</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- Kelola Murid -->
                                <a href="{{ route('admin.kelas.show', $k->id) }}" class="btn btn-info btn-sm text-white rounded-3 fw-semibold px-3 shadow-sm d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-people-fill"></i> Kelola Murid
                                </a>

                                <!-- Edit Nama Kelas Modal Trigger -->
                                <button class="btn btn-warning btn-sm text-white rounded-3 px-3 shadow-sm d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#editKelasModal{{ $k->id }}" title="Edit Nama Kelas">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <!-- Form Hapus Kelas -->
                                <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $k->nama_kelas }}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1" title="Hapus Kelas">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Edit Kelas -->
                        <div class="modal fade" id="editKelasModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                    <form action="{{ route('admin.kelas.update', $k->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-header bg-dark text-white p-4 border-0">
                                            <h5 class="modal-title fw-bold fs-6">Edit Kelas: {{ $k->nama_kelas }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Nama Kelas</label>
                                                <input type="text" name="nama_kelas" class="form-control bg-light rounded-3" value="{{ $k->nama_kelas }}" required>
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
                        <div class="text-center text-muted py-5">
                            <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                                <i class="bi bi-door-closed fs-1 text-secondary opacity-50"></i>
                            </div>
                            <p class="mb-0 fw-medium">Belum ada data kelas yang ditambahkan.</p>
                            <small class="text-muted">Gunakan form di atas untuk menambah kelas baru.</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Gabungkan Pilihan Dropdown sebelum Submit -->
<script>
document.getElementById('formTambahKelas').addEventListener('submit', function(e) {
    const tingkat = document.getElementById('select_tingkat').value;
    const jurusan = document.getElementById('select_jurusan').value;
    const nomor = document.getElementById('select_nomor').value;
    
    // Hasil gabungan contoh: "XII Pemrograman Perangkat Lunak dan Gim 1"
    const namaKelasUtuh = `${tingkat} ${jurusan} ${nomor}`;
    
    document.getElementById('nama_kelas_input').value = namaKelasUtuh;
});
</script>
@endsection