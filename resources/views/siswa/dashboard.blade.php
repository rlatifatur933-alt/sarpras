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

    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; min-height: 400px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Laporan Terbaru</h5>
                    <a href="/history-aspirasi" class="btn btn-sm btn-light text-primary fw-bold" style="border-radius: 10px;">Lihat Semua</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Isi Laporan</th>
                                <th class="border-0">Pelapor</th>
                                <th class="border-0">Tanggal</th>
                                <th class="border-0 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporan_terbaru as $row)
                            <tr>
                                <td class="border-0">
                                    <span class="fw-semibold d-block">{{ Str::limit($row->inputAspirasi->ket, 40) }}</span>
                                    <small class="text-muted">ID: #{{ $row->id_aspirasi }}</small>
                                </td>
                                <td class="border-0">
                                    <span class="text-dark fw-medium small">
                                        {{ $row->inputAspirasi->siswa->username ?? $row->inputAspirasi->nis }}
                                    </span>
                                </td>
                                <td class="border-0 text-muted">{{ $row->created_at->format('d M Y') }}</td>
                                <td class="border-0 text-center">
                                    @if(strtolower($row->status) == 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif(strtolower($row->status) == 'proses' || strtolower($row->status) == 'diproses')
                                        <span class="badge bg-primary">Diproses</span>
                                    @elseif(strtolower($row->status) == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                               <td colspan="4" class="text-center py-5 text-muted">Belum ada laporan yang dikirim.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 20px; background-color: #fcfdff;">
                <div class="mb-3">
                    <div class="bg-primary text-white mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                        {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                    </div>
                </div>
                <h5 class="fw-bold mb-1">{{ auth()->user()->username }}</h5>
                <p class="text-muted small mb-3">Siswa - {{ $siswa->kelas ?? '-' }}</p>
                <hr class="opacity-25">
                <div class="text-start mb-2">
                    <small class="text-muted d-block">NIS Anda:</small>
                    <span class="fw-bold">{{ $siswa->nis ?? '-' }}</span>
                </div>
                <div class="text-start">
                    <small class="text-muted d-block">Email Terdaftar:</small>
                    <span class="fw-bold">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection