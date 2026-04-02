<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpras App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .sidebar { height: 100vh; width: 250px; position: fixed; background: #2c3e50; color: white; transition: all 0.3s; }
        .sidebar a { color: rgba(255,255,255,0.7); text-decoration: none; padding: 15px 25px; display: block; }
        .sidebar a:hover { background: #34495e; color: white; border-left: 4px solid #3498db; }
        .sidebar a.active { background: #1a252f; color: white; border-left: 4px solid #3498db; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-4 text-center">
            <h4 class="fw-bold text-white">SARPRAS</h4>
            <hr class="text-secondary">
        </div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->is('kategori*') ? 'active' : '' }}">🛠 Kategori Barang</a>
        <a href="{{ route('aspirasi.index') }}" class="{{ request()->is('admin/aspirasi*') ? 'active' : '' }}">📂 Laporan Kerusakan</a>
        
        <div style="position: absolute; bottom: 0; width: 100%;" class="p-3">
            <button class="btn btn-danger w-100 btn-sm">Keluar</button>
        </div>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 rounded-3">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 fs-6 text-muted">Selamat Datang, Admin</span>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>