@extends('layouts.siswa_app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Detail Laporan #{{ $laporan->id_aspirasi }}</h5>
                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-sm btn-light rounded-pill">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3"> <label class="text-muted small d-block">Nama Pelapor</label>
                        <span class="fw-bold text-dark">
                            {{ $laporan->inputAspirasi->siswa->username ?? 'Anonim' }}
                        </span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="text-muted small d-block">Status Laporan</label>
                        @if(strtolower($laporan->status) == 'menunggu')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif(strtolower($laporan->status) == 'proses' || strtolower($laporan->status) == 'diproses')
                            <span class="badge bg-primary">Diproses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="text-muted small d-block">Tanggal Kirim</label>
                        <span class="fw-bold">{{ $laporan->created_at->format('d F Y - H:i') }}</span>
                    </div>
                </div>

                <hr class="opacity-25">

                <div class="mb-4">
                    <label class="text-muted small d-block">Isi Laporan / Keluhan</label>
                    <p class="mt-2 p-3 bg-light rounded-4 shadow-sm" style="min-height: 100px;">
                        {{ $laporan->inputAspirasi->ket }}
                    </p>
                </div>

                @if($laporan->feedback)
                <div class="p-3 border-start border-4 border-primary bg-light rounded-3">
                    <label class="text-primary fw-bold small d-block">Feedback dari Admin:</label>
                    <p class="mb-0 mt-1 italic">{{ $laporan->feedback }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection