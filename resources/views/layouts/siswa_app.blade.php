<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SARPRASIN') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-sarprasin.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        table {
            border-collapse: separate;
            border-spacing: 0 12px; 
        }

        thead th {
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #a0aec0;
            letter-spacing: 1px;
            padding-bottom: 20px !important;
        }

        body {
            background-color: #f0f7ff; 
            background-image: linear-gradient(180deg, #e0f0ff 0%, #f0f7ff 100%);
            min-height: 100vh;
        }

        tbody tr {
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        tbody tr td {
            border: none !important;
            padding: 20px 15px !important;
            vertical-align: middle;
        }

        tbody tr:hover {
            transform: translateY(-4px); 
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        tbody tr td:first-child {
            border-left: 5px solid #435ebe !important;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        tbody tr td:last-child {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 50px; 
            font-weight: 600;
            font-size: 0.7rem;
            border: none;
        }

        .bg-danger { 
            background-color: #ffe5e5 !important; 
            color: #d9534f !important; 
            padding: 5px 12px;
        }

        .bg-warning { 
            background-color: #fff4e5 !important; 
            color: #f0ad4e !important; 
            padding: 5px 12px;
        }

        .bg-success { 
            background-color: #e5f9e7 !important; 
            color: #28a745 !important; 
            padding: 5px 12px;
        }

        td img {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            object-fit: cover;
            transition: transform 0.2s;
        }

        td img:hover {
            transform: scale(1.1); 
        }

        .text-muted.small {
            font-size: 0.8rem;
            color: #adb5bd !important;
        }

        .rounded-circle {
            border: 3px solid #f0f2f5;
            box-shadow: 0 4px 10px rgba(67, 94, 190, 0.15);
        }

        .card.mb-4 {
            background-color: #ffffff !important; 
            border: none !important;
            border-left: 6px solid #435ebe !important; 
            border-radius: 15px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important; 
            padding: 10px;
        }

        .card.mb-4 h5 {
            color: #25396f !important;
            font-weight: 800 !important;
        }

        .card.mb-4 .small {
            color: #7c8db5 !important;
        }

        .card.mb-4 .rounded-circle {
            background-color: #e8f0fe !important;
            color: #435ebe !important;
            border: none !important;
            font-weight: bold;
        }
        #sidebar {
            background-color: #1e293b !important; 
            min-width: 280px;
            max-width: 280px;
            height: 100vh;
            position: fixed;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            z-index: 999;
        }

        .sidebar-header {
            padding: 2.5rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 1rem;
        }

        .sidebar-header h3 {
            color: #ffffff;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .nav-item {
            list-style: none;
            padding: 0 15px;
        }

        .nav-link {
            color: #94a3b8 !important; 
            padding: 14px 18px !important;
            border-radius: 12px !important;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
            transform: translateX(8px);
        }

        .nav-link.active, .bg-primary {
            background: #3b82f6 !important; 
            color: #ffffff !important;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3) !important;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
            transition: transform 0.3s;
        }

        .nav-link:hover i {
            transform: rotate(10deg) scale(1.1);
        }

        .logout-wrapper {
            position: absolute;
            bottom: 30px;
            width: 100%;
            padding: 0 15px;
        }

        .btn-danger {
            background-color: #ef4444 !important; 
            border: none !important;
            border-radius: 12px !important;
            padding: 12px !important;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2) !important;
            transition: all 0.3s;
        }

        .btn-danger:hover {
            background-color: #dc2626 !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4) !important;
        }
    </style>
</head>
<body>

    <div id="app" class="d-flex">
        <div id="sidebar" class="active" style="width: 280px; min-height: 100vh; background-color: #25396f; position: fixed;">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header p-4 text-center">
                    <h3 class="text-white fw-bold">SAR<span class="text-primary">PRASIN</span></h3>
                </div>
                <hr class="mx-4" style="color: rgba(255,255,255,0.3)">
                <div class="sidebar-menu px-3">
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item mb-2">
                            <a href="/dashboard-siswa" class="nav-link text-white p-3 rounded {{ request()->is('dashboard-siswa*') || request()->is('dashboard/detail*') ? 'bg-primary shadow' : '' }}">
                                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="/history-aspirasi" class="nav-link text-white p-3 rounded {{ request()->is('history-aspirasi*') ? 'bg-primary shadow' : '' }}">
                                <i class="bi bi-clock-history me-2"></i> Riwayat Laporan
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="/kirim-aspirasi" class="nav-link text-white p-3 rounded {{ request()->is('kirim-aspirasi*') ? 'bg-primary shadow' : '' }}">
                                <i class="bi bi-plus-circle-fill me-2"></i> Kirim Laporan
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-footer p-3" style="position: absolute; bottom: 0; width: 100%;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="main" class="flex-grow-1" style="margin-left: 280px; background-color: #f2f7ff; min-height: 100vh;">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>