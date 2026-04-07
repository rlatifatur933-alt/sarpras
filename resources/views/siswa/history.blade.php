@extends('layouts.siswa_app') {{-- Sesuaikan dengan layout yang lo pake di create.blade.php --}}

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Riwayat Laporan Aspirasi Saya</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Isi Laporan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasi as $key => $a)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ Str::limit($a->isi_laporan, 50) }}</td>
                            <td>{{ $a->created_at->format('d M Y') }}</td>
                            <td>
                                @if($a->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($a->status == 'proses')
                                    <span class="badge bg-info text-dark">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada laporan yang dikirim.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection