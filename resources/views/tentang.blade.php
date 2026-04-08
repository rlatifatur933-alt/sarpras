@extends('layouts.app')

@section('content')
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
                </div>
                <div class="col-lg-3 text-center">
                    <img src="https://img.freepik.com/free-vector/maintenance-concept-illustration_114360-391.jpg" class="img-fluid hero-img" ...>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection