@extends('layouts.app') {{-- Asumsi kamu pakai layout utama --}}

@section('content')
<style>
   .border-primary {
        border-color: #3498db !important; /* Biru sidebar */
    }

    .page-title-box {
        background: linear-gradient(to right, rgba(52, 152, 219, 0.05), transparent);
        padding: 1.5rem;
        border-radius: 0 15px 15px 0;
    }

    h2 {
        font-size: 1.8rem;
        color: #2c3e50;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3) !important;
    }

    .btn-add {
        position: relative !important;
        z-index: 1050 !important; 
        cursor: pointer !important;
    }
</style>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid py-4">
    <div class="page-title-box pb-3 mb-4 border-bottom">
        <div class="d-flex align-items-center justify-content-between">
            <div class="border-start border-primary border-5 ps-3">
                <h2 class="fw-bold text-dark mb-0" style="letter-spacing: -0.5px; font-family: 'Plus Jakarta Sans', sans-serif;">
                    Daftar <span class="text-primary">Kategori</span> Aspirasi
                </h2>
                <p class="text-muted small mb-0 mt-1">
                    <i class="bi bi-info-circle me-1"></i> Kelola kategori sarana dan prasarana sekolah secara terpusat.
                </p>
            </div>
            <button class="btn btn-primary btn-add ..." data-bs-toggle="modal" data-bs-target="#tambahKategori">
                + Tambah Kategori
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 border-0 py-3" width="10%">ID</th>
                            <th class="border-0 py-3">Keterangan Kategori</th>
                            <th class="text-center pe-4 border-0 py-3" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $k)
                        <tr style="transition: all 0.2s ease;">
                            <td class="ps-4">
                                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-medium">
                                    #{{ $k->id_kategori }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-square bg-primary-subtle rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        <i class="bi bi-tag-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $k->ket_kategori }}</span>
                                        <small class="text-muted">Kategori aktif</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link text-primary text-decoration-none p-0 fw-semibold me-3" data-bs-toggle="modal" data-bs-target="#editKategori{{ $k->id_kategori }}">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </button>
                                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 fw-semibold" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash3 me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="editKategori{{ $k->id_kategori }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('kategori.update', $k->id_kategori) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nama Kategori</label>
                                                <input type="text" name="ket_kategori" class="form-control" value="{{ $k->ket_kategori }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="modal fade" id="tambahKategori" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('kategori.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="fw-bold">Nama Kategori</label>
                                                <input type="text" name="ket_kategori" class="form-control" placeholder="Masukkan nama kategori..." required>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection