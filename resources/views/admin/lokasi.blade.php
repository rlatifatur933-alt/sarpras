@extends('layouts.app')

@section('content')
<style>
    .table {
        border-collapse: separate;
        border-spacing: 0 12px; 
    }

    .table thead th {
        border: none;
        color: #94a3b8; 
        font-size: 0.7rem; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 2px; 
        padding-top: 25px;
        padding-bottom: 15px;
        background-color: transparent; 
    }

    .table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .table tbody tr td {
        border: none;
        padding: 1.2rem 1rem;
    }

    .table tbody tr td:first-child { border-radius: 12px 0 0 12px; }
    .table tbody tr td:last-child { border-radius: 0 12px 12px 0; }

    .table tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        background-color: #ffffff !important;
    }

    .icon-square {
        width: 48px;
        height: 48px;
        background: #f0f7ff;
        color: #435ebe;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: 0.3s;
    }

    .table tbody tr:hover .icon-square {
        background: #435ebe;
        color: #ffffff;
    }

    .main-title {
        font-weight: 800;
        color: #25396f;
        font-size: 1.75rem;
        letter-spacing: -1px;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.2s;
        border: none;
        background: #f8f9fa;
    }

    .btn-edit:hover { background: #e0e7ff; color: #435ebe; }
    .btn-delete:hover { background: #fee2e2; color: #ef4444; }
</style>
<div class="page-heading d-flex justify-content-between align-items-center mb-4">
    <div class="title-section">
        <h3 class="main-title mb-0">Daftar Lokasi</h3>
        <p class="text-muted small mb-0">Manajemen aset dan titik lokasi sarana prasarana</p>
    </div>
    <button class="btn btn-primary rounded-pill px-4 shadow-sm btn-add" data-bs-toggle="modal" data-bs-target="#tambahLokasi">
        <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
    </button>
</div>

<div class="page-content">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" width="10%">
                                <i class="bi bi-hash me-1"></i> ID
                            </th>
                            <th>
                                <i class="bi bi-geo-alt me-1"></i> Nama Lokasi
                            </th>
                            <th class="text-end pe-4" width="20%">
                                <i class="bi bi-gear me-1"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokasi as $l)
                        <tr style="transition: all 0.2s ease;">
                            <td class="ps-4">
                                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-medium">
                                    #{{ $l->id_lokasi }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-square me-3">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $l->nama_lokasi }}</span>
                                        <small class="text-muted"><span class="text-success small">●</span> Lokasi aktif</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-outline-primary btn-sm border-0 fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#editLokasi{{ $l->id_lokasi }}">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </button>

                                <form action="{{ route('lokasi.destroy', $l->id_lokasi) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0 fw-semibold" onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                                        <i class="bi bi-trash3 me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editLokasi{{ $l->id_lokasi }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Lokasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('lokasi.update', $l->id_lokasi) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Lokasi</label>
                                                <input type="text" name="nama_lokasi" class="form-control" value="{{ $l->nama_lokasi }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary rounded-pill">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahLokasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lokasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lokasi</label>
                        <input type="text" name="nama_lokasi" class="form-control" placeholder="Misal: Ruang Lab 1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Tambah Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection