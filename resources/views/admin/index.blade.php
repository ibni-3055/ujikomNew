@extends('layouts.app')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-shield-lock-fill fs-6"></i> Hak Akses Pengguna
        </span>
        <h3 class="fw-bold text-dark mb-1">Pengelolaan Data Admin</h3>
        <p class="text-muted small mb-0">Atur akun pengelola sistem, perbarui username, atau buat password baru.</p>
    </div>
    <button class="btn btn-dark d-lg-none shadow-sm" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
</div>

<div class="row g-4">
    <!-- Form Tambah Admin (Di Atas) -->
    <div class="col-12">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 bg-primary bg-opacity-10 border-bottom border-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Tambah Admin Baru</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Masukkan username dan password pengelola</small>
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

                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <!-- Input User / Username -->
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-secondary">User / Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-start-0" placeholder="Masukkan username" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-secondary">Password <span class="fw-normal text-muted">(Min. 8 Karakter)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-key"></i></span>
                                <input type="password" id="addPassword" name="password" class="form-control bg-light border-start-0 border-end-0" placeholder="••••••••" required minlength="8">
                                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('addPassword', this)">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
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

    <!-- List Daftar Admin (Di Bawah) -->
    <div class="col-12">
        <div class="card card-custom border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-dark text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-people-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Daftar Admin Terdaftar</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">Total pengelola aktif yang ada di sistem</small>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="list-group list-group-flush">
                    @forelse($users ?? [] as $u)
                        <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-3 mb-2 rounded-3 border bg-light bg-opacity-50 hover-shadow transition-all gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px; font-size: 1.1rem;">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">{{ $u->name }}</h6>
                                    <span class="text-muted small d-flex align-items-center gap-2" style="font-size: 0.75rem;">
                                        <span><i class="bi bi-key me-1"></i> Password: <code class="text-secondary">••••••••</code></span>
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- Edit Admin Modal Trigger -->
                                <button class="btn btn-warning btn-sm text-white rounded-3 px-3 shadow-sm d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#editAdminModal{{ $u->id }}" title="Edit Admin">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <!-- Form Hapus Admin -->
                                <form action="{{ route('admin.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $u->name }}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1" title="Hapus Admin">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Edit Admin -->
                        <div class="modal fade" id="editAdminModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                    <form action="{{ route('admin.update', $u->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="modal-header bg-dark text-white p-4 border-0">
                                            <h5 class="modal-title fw-bold fs-6">Edit Admin: {{ $u->name }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        
                                        <div class="modal-body p-4 text-start">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">User / Username</label>
                                                <input type="text" name="name" class="form-control bg-light rounded-3" value="{{ $u->name }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small fw-semibold text-muted">Password Baru <span class="fw-normal text-muted">(Kosongkan jika tidak diubah)</span></label>
                                                <div class="input-group">
                                                    <input type="password" id="editPassword{{ $u->id }}" name="password" class="form-control bg-light border-end-0 rounded-start-3" minlength="8" placeholder="••••••••">
                                                    <button class="btn btn-light border border-start-0 text-muted rounded-end-3" type="button" onclick="togglePassword('editPassword{{ $u->id }}', this)">
                                                        <i class="bi bi-eye-slash"></i>
                                                    </button>
                                                </div>
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
                                <i class="bi bi-people fs-1 text-secondary opacity-50"></i>
                            </div>
                            <p class="mb-0 fw-medium">Belum ada data admin yang ditambahkan.</p>
                            <small class="text-muted">Gunakan form di atas untuk menambah admin baru.</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
</script>
@endsection