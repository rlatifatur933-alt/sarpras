@extends('layouts.siswa_app') {{-- Sesuaikan dengan layout yang lo pake di create.blade.php --}}

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xl me-3">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=0D6EFD&color=fff" alt="User" class="rounded-circle" style="width: 50px;">
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">Halo, Siswa {{ auth()->user()->username }}</h5>
                    <p class="mb-0 text-muted small">Log aktivitas laporan untuk NIS Anda.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary">Riwayat Laporan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Isi Laporan</th>
                            <th width="20%">Tanggal</th>
                            <th width="17%">Foto</th>
                            <th width="15%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasi as $key => $a)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ Str::limit($a->inputAspirasi->ket ?? 'Tanpa Keterangan', 40) }}</div>
                                <small class="text-muted">ID: #{{ $a->id_pelaporan }}</small>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $a->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                            <a href="{{ asset('uploads/aspirasi/' . $a->inputAspirasi->foto) }}" target="_blank">
                                <img src="{{ asset('uploads/aspirasi/' . $a->inputAspirasi->foto) }}" 
                                    alt="bukti" 
                                    class="rounded shadow-sm" 
                                    style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #ddd;">
                            </a>
                            </td>
                            <td class="text-center">
                                @php $status = strtolower($a->status); @endphp
                                @if($status == 'menunggu' || $status == 'pending')
                                    <span class="badge rounded-pill bg-light-danger text-danger px-3">Menunggu</spa--n>
                                @elseif($status == 'proses' || $status == 'in progress')
                                    <span class="badge rounded-pill bg-light-warning text-warning px-3">Diproses</span>
                                @elseif($status == 'selesai')
                                    <span class="badge rounded-pill bg-light-success text-success px-3">Selesai</span>
                                @else
                                    <span class="badge rounded-pill bg-light-secondary text-secondary px-3">{{ $a->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/empty-states.svg" alt="empty" style="width: 150px;">
                                <p class="mt-3 text-muted">Belum ada laporan yang kamu kirimkan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection