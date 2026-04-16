@extends('layouts.siswa_app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-primary text-white shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h3 class="fw-bold">Selamat Datang, {{ auth()->user()->username }}! 👋</h3>
                    <p class="mb-0">Cek ringkasan laporan fasilitas sekolah kamu di sini secara real-time.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #435ebe !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="stats-icon mb-2 me-3" style="background-color: #ebf3ff; padding: 15px; border-radius: 10px;">
                        <i class="bi bi-file-earmark-text-fill text-primary fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted font-semibold">Total Laporan</h6>
                        <h4 class="font-extrabold mb-0">{{ $total_laporan }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #ff7976 !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="stats-icon mb-2 me-3" style="background-color: #ffe5e5; padding: 15px; border-radius: 10px;">
                        <i class="bi bi-clock-history text-danger fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted font-semibold">Menunggu</h6>
                        <h4 class="font-extrabold mb-0">{{ $laporan_pending }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #57ca85 !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="stats-icon mb-2 me-3" style="background-color: #e8f9ef; padding: 15px; border-radius: 10px;">
                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted font-semibold">Selesai</h6>
                        <h4 class="font-extrabold mb-0">{{ $laporan_selesai }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection