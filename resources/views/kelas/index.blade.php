@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Tambah Kelas</h5>
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <input type="text" name="nama_kelas" class="form-control mb-2" placeholder="Nama Kelas" required>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card p-3 shadow-sm">
            <h5>Daftar Kelas</h5>
            <ul class="list-group">
                @foreach($kelases as $k)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $k->nama_kelas }}
                    <div>
                        <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-info btn-sm text-white">Kelola Murid</a>
                        <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kelas?')">Hapus</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection