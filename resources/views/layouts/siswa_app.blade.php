<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpas - Layanan Aspirasi Siswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .main-content { min-height: 80vh; padding: 40px 0; }
        .footer { background: #fff; padding: 20px 0; border-top: 1px solid #dee2e6; }
        .nav-link.active { font-weight: bold; color: #0d6efd !important; border-bottom: 2px solid #0d6efd; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-megaphone-fill"></i> SARPRAS SISWA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('aspirasi/create') ? 'active' : '' }}" href="{{ url('/aspirasi/create') }}">Buat Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('riwayat*') ? 'active' : '' }}" href="{{ route('siswa.history') }}">Riwayat Saya</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">Halo, {{ auth()->user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <span class="text-muted">&copy; 2026 Sarpras - Sistem Aspirasi Siswa</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>