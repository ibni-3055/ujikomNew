<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DB Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">DB Sekolah</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
    <li class="nav-item"><a class="nav-link text-white" href="{{ route('kelas.index') }}">Data Kelas & Murid</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="{{ route('berita.index') }}">Berita Sekolah</a></li>
    <li class="nav-item"><a class="nav-link text-white fw-bold" href="{{ route('admin.index') }}">Kelola Admin</a></li>
</ul>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">@yield('content')</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>