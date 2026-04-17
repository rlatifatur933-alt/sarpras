@extends('layouts.app') @section('content')
@if(auth()->user()->role == 'siswa')
    <script>window.location = "{{ url('/history-aspirasi') }}";</script>
@endif
<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; background: linear-gradient(135deg, #00b4db 0%, #0083b0 100%);">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold text-white mb-1">Selamat Datang, {{ auth()->user()->username }}! 👋</h3>
                <p class="text-white opacity-75 mb-0">Senang melihat Anda kembali. Berikut adalah ringkasan laporan sarpras hari ini.</p>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <i class="bi bi-person-workspace text-white opacity-25" style="font-size: 4rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-uppercase" style="font-size: 0.8rem;">Total Keluhan</h6>
                                    <h2 class="font-extrabold mb-0">{{ $total }}</h2>
                                </div>
                                <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-center align-items-center">
                                    <div class="stats-icon blue mb-2" style="border-radius: 10px; width: 3rem; height: 3rem;">
                                        <i class="iconly-boldPaper text-white" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-uppercase" style="font-size: 0.8rem;">Pending</h6>
                                    <h2 class="font-extrabold mb-0">{{ $menunggu }}</h2>
                                </div>
                                <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-center align-items-center">
                                    <div class="stats-icon red mb-2" style="background-color: #ffdce0; border-radius: 10px; width: 3rem; height: 3rem;">
                                         <i class="bi bi-exclamation-circle text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-uppercase" style="font-size: 0.8rem;">In Progress</h6>
                                    <h2 class="font-extrabold mb-0">{{ $proses }}</h2>
                                </div>
                                <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-center align-items-center">
                                    <div class="stats-icon yellow mb-2" style="background-color: #fffac2; border-radius: 10px; width: 3rem; height: 3rem;">
                                        <i class="iconly-boldActivity" style="color: #ecc94b; font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-uppercase" style="font-size: 0.8rem;">Selesai</h6>
                                    <h2 class="font-extrabold mb-0">{{ $selesai }}</h2>
                                </div>
                                <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-center align-items-center">
                                    <div class="stats-icon green mb-2" style="background-color: #e2fbd7; border-radius: 10px; width: 3rem; height: 3rem;">
                                        <i class="iconly-boldTick-Square" style="color: #38a169; font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-white border-0 py-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon purple me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-graph-up-arrow text-white" style="font-size: 1.2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-0" style="color: #051339;">Persentase Laporan</h4>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="badge bg-light-danger text-danger mb-1">MENUNGGU</span>
                                <p class="text-muted small mb-0">Laporan baru yang belum diproses</p>
                            </div>
                            <h4 class="fw-extrabold text-danger mb-0">{{ $p_menunggu }}%</h4>
                        </div>
                        <div class="progress" style="height: 15px; border-radius: 10px; background-color: #f8d7da;">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" 
                                role="progressbar" style="width: {{ $p_menunggu }}%; border-radius: 10px;"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="badge bg-light-warning text-warning mb-1">PROSES</span>
                                <p class="text-muted small mb-0">Sedang ditangani oleh teknisi</p>
                            </div>
                            <h4 class="fw-extrabold text-warning mb-0">{{ $p_proses }}%</h4>
                        </div>
                        <div class="progress" style="height: 15px; border-radius: 10px; background-color: #fff3cd;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" 
                                role="progressbar" style="width: {{ $p_proses }}%; border-radius: 10px;"></div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="badge bg-light-success text-success mb-1">SELESAI</span>
                                <p class="text-muted small mb-0">Perbaikan telah dikonfirmasi berhasil</p>
                            </div>
                            <h4 class="fw-extrabold text-success mb-0">{{ $p_selesai }}%</h4>
                        </div>
                        <div class="progress" style="height: 15px; border-radius: 10px; background-color: #d1e7dd;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                role="progressbar" style="width: {{ $p_selesai }}%; border-radius: 10px;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection