@extends('layouts.app') 
@section('content')
<style>
    /* Import font biar lebih modern */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

    body {
        background-color: #f3f4f7;
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    /* Sidebar Styling */
    .sidebar {
        background: #1e293b !important; /* Navy gelap yang lebih elegan */
        padding-top: 20px;
    }

    .sidebar .nav-link {
        color: #94a3b8;
        margin: 4px 15px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .sidebar .nav-link.active {
        background-color: #334155 !important;
        color: #f8fafc !important;
        font-weight: 600;
    }

    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    /* Container & Card */
    .main-content {
        padding: 30px;
    }

    .card-custom {
        background: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 20px;
    }

    /* Tabel Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0 8px; /* Kasih jarak antar baris */
    }

    .table thead th {
        background: transparent;
        border: none;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 15px;
    }

    .table tbody tr {
        background-color: #ffffff;
        transition: transform 0.2s;
    }

    .table tbody tr td {
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        padding: 15px;
    }

    /* Efek pas baris di-hover */
    .table tbody tr:hover {
        background-color: #f8fafc;
        cursor: pointer;
    }

    /* Styling Status Badge (Biar gak kaku) */
    .badge {
        padding: 6px 12px;
        border-radius: 30px; /* Bentuk kapsul */
        font-weight: 500;
        font-size: 0.75rem;
    }

    .status-pending {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .status-progress {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-done {
        background-color: #dcfce7;
        color: #166534;
    }

    /* Button Edit Custom */
    .btn-outline-edit {
        border: 1.5px solid #e2e8f0;
        background: white;
        color: #64748b;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-outline-edit:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
</style>
<div class="page-heading">
    <h3 class="fw-bold">Data Pengaduan Sarana</h3>
    <p class="text-muted">Manajemen Pengaduan Sarana dan Prasarana</p>
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
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $row)
                        <tr>
                            <td class="text-center text-muted">{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $row->kategori->ket_kategori ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $row->ket }}</small>
                            </td>
                            <td>{{ $row->lokasi }}</td>
                            <td>
                                {{-- Karena kita di dalam loop $laporan, dan $laporan itu isinya InputAspirasi --}}
                                @if($row->foto && $row->foto != 'default.png')
                                    <a href="{{ asset('uploads/aspirasi/' . $row->foto) }}" target="_blank">
                                        <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" 
                                            class="img-thumbnail" 
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </a>
                                @else
                                    <span class="text-muted small">Tidak ada foto</span>
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
                                <button type="button" class="btn btn-sm btn-outline-edit" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $row->id_pelaporan }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <div class="modal fade" id="modalUpdate{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">Update Laporan #{{ $row->id_pelaporan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start text-dark">
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>Pending</option>
                                                            <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>In Progress</option>
                                                            <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold text-dark">Feedback Admin</label>
                                                        <textarea name="feedback" class="form-control" rows="3">{{ $row->aspirasi->feedback ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection