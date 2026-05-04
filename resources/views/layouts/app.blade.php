<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SARPRASIN') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-sarprasin.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .sidebar { height: 100vh; width: 250px; position: fixed; background: #2c3e50; color: white; transition: all 0.3s; }
        .sidebar a { color: rgba(255,255,255,0.7); text-decoration: none; padding: 15px 25px; display: block; }
        .sidebar a:hover { background: #34495e; color: white; border-left: 4px solid #3498db; }
        .sidebar a.active { background: #1a252f; color: white; border-left: 4px solid #3498db; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .nav-link.active {
            background: #3498db !important; 
            color: white !important;
            font-weight: bold;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f0f7ff !important; 
        }
        .main-content { 
            margin-left: 250px; 
            padding: 30px; 
            background-color: #f0f7ff; 
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: #ffffff !important;
        }
    </style>
</head>
<body>

    <div class="sidebar shadow">
            <div class="sidebar-header p-4 text-center">
                <h3 class="text-white fw-bold p-4 mb-0 text-center">
                    SAR<span class="text-primary">PRASIN</span>
                </h3>
                <div class="mx-4 mb-4" style="border-bottom: 2px solid rgba(255, 255, 255, 0.2); height: 1px;"></div>
            </div>
    <div class="p-4">
            @auth
                {{-- Ini hanya tampil kalau sudah LOGIN --}}
                @if(auth()->user()->role == 'admin')
                    <h6 class="text-muted small uppercase mb-3 ps-2" style="letter-spacing: 1px;"></h6>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center mb-2 {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-3"></i> Dashboard
                    </a>
                    <a href="{{ route('kategori.index') }}" class="nav-link d-flex align-items-center mb-2 {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill me-3"></i> Kategori Barang
                    </a>
                    <a href="{{ route('lokasi.index') }}" class="nav-link d-flex align-items-center mb-2 {{ request()->is('lokasi*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt-fill me-3"></i> Data Lokasi
                    </a>
                    <a href="{{ route('aspirasi.index') }}"  class="nav-link {{ request()->is('admin/aspirasi*') || request()->is('admin/detail*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-megaphone me-2"></i>
                        Laporan Kerusakan
                    </a>
                    <a href="{{ route('siswa.index') }}" class="nav-link d-flex align-items-center mb-2 {{ request()->is('siswa*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-3"></i> Data Siswa
                    </a>
                @else
                    <h6 class="text-muted small uppercase">Menu Siswa</h6>
                    <a href="{{ url('/history-aspirasi') }}" class="nav-link">Riwayat Laporan</a>
                @endif
            @else
                {{-- Ini tampil untuk PUBLIK (Belum Login) --}}
                <h4 class="text-muted small uppercase">Menu Tamu</h4>
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ route('tentang') }}" class="nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>
                <hr>
                <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-2">Login</a>
            @endauth
        </div>
        <div style="position: absolute; bottom: 0; width: 100%;" class="p-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100 btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>