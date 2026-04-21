@extends('layouts.app') 
@section('content')
<style>
    .page-heading h2 {
        color: #25396f !important;
        font-weight: 800 !important;
        font-size: 2.1rem !important;
        letter-spacing: -1.2px !important;
        margin-bottom: 8px !important;
        display: inline-block;
        position: relative;
    }

    .page-heading h2::after {
        content: '';
        display: block;
        width: 60%; 
        height: 6px;
        background: linear-gradient(90deg, #435ebe 0%, rgba(67, 94, 190, 0.1) 100%);
        border-radius: 10px;
        margin-top: 5px;
    }

    .page-heading p, 
    .text-subtitle {
        color: #6c757d !important;
        font-size: 1.1rem !important;
        font-weight: 500 !important;
        margin-top: 10px !important;
        opacity: 0.8;
    }

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    body {
        background-color: #f0f7ff; 
        font-family: 'Inter', sans-serif;
        color: #334155;
        min-height: 100vh;
    }

    .table {
        border-collapse: separate;
        border-spacing: 0 12px; 
    }

    .table thead th {
        border: none !important;
        color: #25396f !important; 
        font-size: 0.9rem !important; 
        font-weight: 800 !important; 
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px !important;
    }

    .table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }

    .table tbody tr td {
        vertical-align: middle;
        border: none;
        padding: 20px 15px;
    }

    .table tbody tr td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        border-left: 5px solid #3b82f6;
    }

    .table tbody tr td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .table tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .badge {
        padding: 8px 14px;
        border-radius: 10px; 
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background-color: #ffe5e5; color: #d9534f; }
    .status-progress { background-color: #fff4e5; color: #f0ad4e; }
    .status-done { background-color: #e5f9e7; color: #28a745; }

    .modal-detail-label {
        font-weight: 700;
        color: #435ebe;
        font-size: 0.9rem;
        margin-bottom: 0;
    }
</style>

<div class="page-heading">
    <h2>Data Pengaduan Sarana</h2>
    <p>Manajemen Pengaduan Sarana dan Prasarana</p>
</div>

<div class="page-content">
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="table1">
                    <thead>
                        <tr>
                            <th>TANGGAL</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th>FOTO</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">AKSI</th> 
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($laporan as $row)
                        <tr>
                            <td class="text-center text-muted">{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $row->kategori->ket_kategori ?? 'N/A' }}</div>
                                <small class="text-muted text-truncate" style="max-width: 150px; display: block;">{{ $row->ket }}</small>
                            </td>
                            <td>{{ $row->lokasi }}</td>
                            <td>
                                @if($row->foto && $row->foto != 'default.png')
                                    <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" 
                                         class="rounded shadow-sm" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">No Photo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($row->aspirasi)
                                    @if($row->aspirasi->status == 'menunggu')
                                        <span class="badge rounded-pill status-pending">Pending</span>
                                    @elseif($row->aspirasi->status == 'proses')
                                        <span class="badge rounded-pill status-progress">In Progress</span>
                                    @else
                                        <span class="badge rounded-pill status-done">Done</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $row->id_pelaporan }}">
                                        Detail
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id_pelaporan }}">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    
                @foreach($laporan as $row)
                    <div class="modal fade" id="detailModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="border-radius: 15px; border: none;">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold" style="color: #25396f;">Detail Laporan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-md-5 mb-3 text-center">
                                            <p class="modal-detail-label mb-2">Foto Bukti</p>
                                            @if($row->foto && $row->foto != 'default.png')
                                                <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" class="img-fluid rounded shadow" style="max-height: 300px; width: 100%; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                                    <p class="text-muted">Tidak ada foto</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <p class="modal-detail-label">Pelapor</p>
                                                <p class="fw-semibold">{{ $row->siswa->username ?? 'Siswa' }}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <p class="modal-detail-label">Tanggal</p>
                                                    <p>{{ $row->created_at->format('d F Y') }}</p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <p class="modal-detail-label">Kategori</p>
                                                    <p>{{ $row->kategori->ket_kategori ?? '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <p class="modal-detail-label">Lokasi</p>
                                                <p>{{ $row->lokasi }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <p class="modal-detail-label">Keterangan Kerusakan</p>
                                                <p class="bg-light p-2 rounded">{{ $row->ket }}</p>
                                            </div>
                                            @if($row->aspirasi && $row->aspirasi->feedback)
                                            <div class="mb-3">
                                                <p class="modal-detail-label text-success">Feedback Admin</p>
                                                <p class="bg-light p-2 rounded border-start border-success border-4 italic">{{ $row->aspirasi->feedback }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Laporan: {{ $row->siswa->username }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="fw-bold">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>Pending</option>
                                                <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>In Progress</option>
                                                <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>Done</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Feedback Admin</label>
                                            <textarea name="feedback" class="form-control" rows="3">{{ $row->aspirasi->feedback ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection