@extends('layouts.app') <!-- Pastikan ini nama file layout utamamu -->

@section('content')
<div class="container-fluid py-4">

        <form action="{{ route('admin.aspirasi.update', $aspirasi->id_pelaporan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Detail Laporan</h2>
                <a href="{{ route('aspirasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <label class="text-primary small fw-bold text-uppercase mb-3 d-block">Foto Bukti</label>
                            <img src="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" 
                                class="img-fluid rounded-4 mb-4 shadow-sm w-100" 
                                style="aspect-ratio: 4/3; object-fit: cover;">
                            
                            <div class="mb-3">
                                <span class="info-label">Nama Pelapor</span>
                                <div class="info-value">{{ $aspirasi->siswa->username ?? 'Anonym' }}</div>
                            </div>
                            
                            <div>
                                <label class="text-muted small fw-bold text-uppercase d-block">Tanggal Masuk</label>
                                <p class="text-dark mb-0">{{ $aspirasi->created_at->format('d M Y (H:i)') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Keterangan, Status & Feedback -->
                <div class="col-lg-7 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                        <div class="card-body p-4 d-flex flex-column">
                            
                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label class="text-primary small fw-bold text-uppercase mb-2 d-block">Keterangan Siswa</label>
                                <div class="p-3 bg-light rounded-3 border-0" style="min-height: 100px;">
                                    {{ $aspirasi->ket }}
                                </div>
                            </div>

                            <hr class="opacity-50">

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="text-primary small fw-bold text-uppercase mb-2 d-block">Status Laporan</label>
                                @php 
                                    $status = $aspirasi->aspirasi->status ?? 'menunggu';
                                    $badgeClass = [
                                        'menunggu' => 'bg-warning text-dark',
                                        'proses'   => 'bg-info text-white',
                                        'selesai'  => 'bg-success text-white'
                                    ][$status] ?? 'bg-secondary text-white';
                                @endphp
                                <div>
                                    <span class="badge rounded-pill {{ $badgeClass }} px-4 py-2 fs-6">
                                        {{ strtoupper($status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Tanggapan -->
                            <div class="mt-auto">
                                <label class="text-primary small fw-bold text-uppercase mb-2 d-block">Tanggapan Admin</label>
                                <div class="p-3 bg-white rounded-3 border" style="min-height: 120px; color: #666; font-style: italic;">
                                    {{ $aspirasi->aspirasi->feedback ?? 'Belum ada tanggapan.' }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection