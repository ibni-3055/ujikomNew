@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Upload Berita</h5>
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="judul" class="form-control mb-2" placeholder="Judul" required>
                <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" required></textarea>
                <input type="file" name="foto" class="form-control mb-2">
                <label class="form-label">Tanggal & Jam Upload</label>
                <input type="datetime-local" name="tanggal_upload" class="form-control mb-2" required>
                <button type="submit" class="btn btn-success w-100">Terbitkan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            @foreach($beritas as $b)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100">
                    @if($b->foto)
                        <img src="{{ asset('storage/' . $b->foto) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6>{{ $b->judul }}</h6>
                        <p class="small text-muted mb-1">📅 {{ $b->tanggal_upload }}</p>
                        <p class="card-text">{{ $b->deskripsi }}</p>
                        <form action="{{ route('berita.destroy', $b->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection