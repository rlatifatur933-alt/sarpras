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
            border-spacing: 0 12px; /* Memberi jarak antar baris agar jadi card */
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
            transform: translateY(-4px); /* Efek melayang ke atas */
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