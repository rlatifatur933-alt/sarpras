@extends('layouts.app')

@section('content')
<style>
    
    .card {
        border: none !important;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.4s ease;
    }

    .text-navy {
        background: linear-gradient(45deg, #001f3f, #007bff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800 !important;
    }

    .stats-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    .blue { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); }
    .green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }

    .row.mt-5.pt-3 {
        background: #f8fafc;
        border-radius: 15px;
        padding: 20px 10px;
        border: 1px solid #edf2f7;
    }
    
    .row.mt-5 h4 {
        font-size: 1.8rem;
        margin-bottom: 0;
    }

    .img-fluid.hero-img {
        margin-left: 80px; 
        animation: float 4s ease-in-out infinite; 
        filter: drop-shadow(0 15px 15px rgba(0,0,0,0.1)); 
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    .border-top { border-top: 1px solid #eee !important; }

    .img-fluid.hero-img {
        margin-top: -150px;
        margin-left: 100px;
    }

    .bg-primary-soft {
        background-color: #eef2ff;
    }
    .bg-success-soft {
        background-color: #ecfdf5;
    }
    
    .step-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }

    .col-4:hover .step-circle {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    
    .border-start {
        border-left: 1px solid #f1f1f1 !important;
    }
</style>
<div class="page-content">
    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="fw-bold text-navy mb-4">Mengenal SARPRASIN</h1>
                    <p class="text-muted shadow-none lead">
                        SARPRASIN (Sistem Aspirasi Sarana & Prasarana) adalah wadah digital bagi seluruh warga sekolah 
                        untuk berkontribusi dalam menjaga kualitas fasilitas belajar mengajar.
                    </p>
                    <div class="mt-4">
                        <div class="d-flex mb-3">
                            <div class="stats-icon blue me-3"><i class="bi bi-shield-check text-white"></i></div>
                            <div>
                                <h6 class="fw-bold mb-0">Pelaporan Mudah</h6>
                                <small>Siswa dapat melaporkan kerusakan dalam hitungan detik.</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="stats-icon green me-3"><i class="bi bi-clock-history text-white"></i></div>
                            <div>
                                <h6 class="fw-bold mb-0">Transparansi Status</h6>
                                <small>Pantau progres perbaikan secara real-time dari dashboard.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 pt-4 border-top">
                        <div class="col-12 mb-3">
                            <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Cara Melapor:</h6>
                        </div>
                        <div class="col-4 text-center">
                            <div class="step-circle bg-primary-soft text-primary mb-2 mx-auto">1</div>
                            <p class="small fw-bold mb-1">Ambil Foto</p>
                            <p class="text-muted" style="font-size: 0.7rem;">Potret fasilitas yang rusak dengan jelas.</p>
                        </div>
                        <div class="col-4 text-center border-start">
                            <div class="step-circle bg-primary-soft text-primary mb-2 mx-auto">2</div>
                            <p class="small fw-bold mb-1">Isi Form</p>
                            <p class="text-muted" style="font-size: 0.7rem;">Ceritakan detail lokasi & jenis kerusakan.</p>
                        </div>
                        <div class="col-4 text-center border-start">
                            <div class="step-circle bg-success-soft text-success mb-2 mx-auto">3</div>
                            <p class="small fw-bold mb-1">Pantau</p>
                            <p class="text-muted" style="font-size: 0.7rem;">Cek status perbaikan secara berkala.</p>
                        </div>
                    </div>
                    <div class="mt-5 pt-4 text-center border-top">
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            &copy; 2026 <strong>SARPRASIN</strong>. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> untuk sekolah lebih baik.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <img src="{{ asset('img/hero-sarprasin.png') }}" class="img-fluid hero-img" alt="Logo Sarprasin">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection