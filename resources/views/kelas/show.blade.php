@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Tambah Murid di {{ $kelas->nama_kelas }}</h5>
            <form action="{{ route('murid.store', $kelas->id) }}" method="POST">
                @csrf
                <input type="text" name="nisn" class="form-control mb-2" placeholder="NISN" required>
                <input type="text" name="nis" class="form-control mb-2" placeholder="NIS" required>
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Murid" required>
                <button type="submit" class="btn btn-success w-100">Tambah Murid</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card p-3 shadow-sm">
            <h5>Siswa di {{ $kelas->nama_kelas }}</h5>
            <table class="table">
                <thead><tr><th>NISN</th><th>NIS</th><th>Nama</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($kelas->murids as $m)
                    <tr>
                        <td>{{ $m->nisn }}</td>
                        <td>{{ $m->nis }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>
                            <form action="{{ route('murid.destroy', $m->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection