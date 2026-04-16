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

    .sidebar {
        background: #1e293b !important; 
        padding-top: 20px;
    }

    .sidebar .nav-link {
        color: #94a3b8;
        margin: 4px 15px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        border-left: 4px solid #3b82f6;
        border-radius: 0 8px 8px 0;
        font-weight: 600;
    }

    .main-content {
        padding: 30px;
    }

    .card-custom {
        background: transparent;
        border: none;
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
        cursor: pointer;
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

    .table img {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-outline-edit {
        border: 1.5px solid #e2e8f0;
        background: white;
        color: #64748b;
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.2s;
    }

    .btn-outline-edit:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        transform: translateY(-2px);
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id_pelaporan }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    
                @foreach($laporan as $row)
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