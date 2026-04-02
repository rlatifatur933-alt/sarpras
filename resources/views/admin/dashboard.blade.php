@extends('layouts.app') @section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3 class="fw-bold">Selamat Datang, {{ Auth::user()->username }}</h3>
            <p class="text-subtitle text-muted">Senang melihat Anda kembali. Berikut adalah ringkasan laporan sarpras hari ini.</p>
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
                                        <i class="iconly-boldTime-Circle" style="color: #ff7976; font-size: 1.2rem;"></i>
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
    </section>
</div>
@endsection