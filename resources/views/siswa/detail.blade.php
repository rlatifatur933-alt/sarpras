@extends('layouts.siswa_app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        {{-- Kita pakai col-12 biar bener-bener penuh di area konten --}}
        <div class="col-12">
            
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Detail Laporan</h3>
                    <p class="text-muted">Informasi lengkap mengenai aspirasi yang kamu kirimkan.</p>
                </div>
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-white shadow-sm rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                {{-- Banner Biru kecil di atas biar senada sama Dashboard --}}
                <div class="bg-primary p-4 text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="opacity-75">ID Aspirasi: #{{ $laporan->id_aspirasi }}</span>
                        @if(strtolower($laporan->status) == 'menunggu')
                            <span class="badge rounded-pill bg-warning text-dark px-3">Menunggu</span>
                        @elseif(strtolower($laporan->status) == 'proses' || strtolower($laporan->status) == 'diproses')
                            <span class="badge rounded-pill bg-info px-3">Diproses</span>
                        @else
                            <span class="badge rounded-pill bg-success px-3">Selesai</span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        {{-- Info Pelapor --}}
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 bg-light">
                                <label class="text-muted small d-block mb-1">Nama Pelapor</label>
                                <h6 class="fw-bold mb-0">{{ $laporan->inputAspirasi->siswa->username ?? 'Anonim' }}</h6>
                            </div>
                        </div>

                        {{-- Info Tanggal --}}
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 bg-light">
                                <label class="text-muted small d-block mb-1">Tanggal Kirim</label>
                                <h6 class="fw-bold mb-0">{{ $laporan->created_at->format('d F Y - H:i') }}</h6>
                            </div>
                        </div>

                        {{-- Isi Laporan --}}
                        <div class="col-12">
                            <div class="p-4 border rounded-4">
                                <label class="text-muted small d-block mb-2">Isi Laporan / Keluhan</label>
                                <p class="mb-0 text-dark" style="line-height: 1.6; font-size: 1.1rem;">
                                    "{{ $laporan->inputAspirasi->ket }}"
                                </p>
                            </div>
                        </div>

                        {{-- Feedback Section --}}
                        <div class="col-12">
                            <div class="p-4 rounded-4" style="background-color: #f0f7ff; border: 1px dashed #0d6efd;">
                                <label class="text-primary fw-bold small d-block mb-2">
                                    <i class="bi bi-chat-left-text me-2"></i>Feedback Admin
                                </label>
                                <p class="mb-0 text-dark">
                                    @if($laporan->feedback)
                                        {{ $laporan->feedback }}
                                    @else
                                        <span class="text-muted italic">Belum ada tanggapan dari admin.</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection