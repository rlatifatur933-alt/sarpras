<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarprasin - Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Badge Soft Colors */
        .bg-light-danger { background-color: #f8d7da; color: #842029; }
        .bg-light-warning { background-color: #fff3cd; color: #664d03; }
        .bg-light-success { background-color: #d1e7dd; color: #0f5132; }
        .bg-light-secondary { background-color: #e2e3e5; color: #41464b; }
        
        .table thead th {
            border-top: none;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .card {
            border-radius: 15px;
        }
        
        .badge {
            font-weight: 600;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    {{-- Panggil Navbar yang tadi kita buat --}}
    @include('layouts.navbar')

    <div class="container mt-4">
        {{-- Tempat isi konten (history, dll) --}}
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>