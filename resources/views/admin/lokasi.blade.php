@extends('layouts.app')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Lokasi</h3>
    <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahLokasi">
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
                            <th class="ps-4" width="10%">ID</th>
                            <th>Nama Lokasi</th>
                            <th class="text-end pe-4" width="20%">Aksi</th>
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
                                    <div class="icon-square bg-primary-subtle rounded-3 me-3 d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                        <i class="bi bi-geo-alt-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $l->nama_lokasi }}</span>
                                        <small class="text-muted">Lokasi aktif</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-link text-primary text-decoration-none p-0 fw-semibold me-3" data-bs-toggle="modal" data-bs-target="#editLokasi{{ $l->id_lokasi }}">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </button>

                                <form action="{{ route('lokasi.destroy', $l->id_lokasi) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 fw-semibold" onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
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