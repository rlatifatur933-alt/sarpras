<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarprasin - Layanan Aspirasi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Nunito', sans-serif; 
            background-color: #f0f5ff; 
        }
        .navbar { 
            background: white; 
            border-bottom: 2px solid #435ebe; 
        }
        .text-mazer { color: #435ebe; }
        .bg-mazer { background-color: #435ebe; }
        
        .hero-section { 
            padding: 100px 0; 
            background: linear-gradient(135deg, #ffffff 50%, #ebf3ff 100%); 
        }
        
        .btn-mazer { 
            background-color: #435ebe; 
            color: white; 
            border-radius: 8px; 
            padding: 12px 30px; 
            font-weight: 700;
            border: none;
            transition: 0.3s;
        }
        .btn-mazer:hover { 
            background-color: #25396f; 
            color: white; 
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.3);
        }
        
        .btn-outline-mazer {
            border: 2px solid #435ebe;
            color: #435ebe;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 700;
        }
        .btn-outline-mazer:hover {
            background-color: #435ebe;
            color: white;
        }

        .nav-link { font-weight: 600; color: #25396f; }
        .nav-link:hover { color: #435ebe; }
        
        .hero-img {
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-mazer fs-3" href="#">
                <i class="fas fa-tools me-2"></i>SARPRASIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang</a></li>
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-mazer px-4">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-mazer px-4">Login Admin</a>
                            @endauth
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-extrabold mb-3 text-mazer" style="font-weight: 800;">
                        Sampaikan Aspirasi <br>Untuk Sekolah Kita!
                    </h1>
                    <p class="lead text-muted mb-5">
                        Bantu kami memperbaiki fasilitas sekolah dengan melaporkan kerusakan atau memberikan saran melalui sistem SARPRASIN.
                    </p>
                    
                    <div class="d-flex gap-3">
                    <a href="{{ route('aspirasi.create') }}" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Laporan
                    </a>
                        <a href="#" class="btn btn-light btn-lg border px-4" style="border-radius: 8px;">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://img.freepik.com/free-vector/maintenance-concept-illustration_114360-391.jpg" class="img-fluid hero-img" ...>
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>