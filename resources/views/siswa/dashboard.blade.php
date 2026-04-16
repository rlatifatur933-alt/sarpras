@extends('layouts.siswa_app')

@section('content')
<style>
    .stat-card {
        transition: transform 0.3s ease, shadow 0.3s ease;
        border-radius: 18px !important;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .stats-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="container-fluid">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(45deg, #007bff, #00d2ff); border-radius: 20px;">
            <div class="card-body p-5 text-white">
                <h2 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->username }}! 👋</h2>
                <p class="opacity-75 mb-0">Pantau status laporan fasilitas sekolahmu dalam satu genggaman.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="stats-icon rounded-4 bg-light-primary text-primary me-3" style="background-color: #e7f1ff;">
                        <i class="bi bi-file-earmark-text-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold">Total Laporan</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $total_laporan }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="stats-icon rounded-4 bg-light-danger text-danger me-3" style="background-color: #fff2f2;">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold">Menunggu</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $laporan_pending }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="stats-icon rounded-4 bg-light-success text-success me-3" style="background-color: #e8fff3;">
                        <i class="bi bi-check-circle-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 fw-semibold">Selesai</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $laporan_selesai }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection