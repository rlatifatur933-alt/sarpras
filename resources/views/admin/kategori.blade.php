@extends('layouts.app') {{-- Asumsi kamu pakai layout utama --}}

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Daftar Kategori Aspirasi</h4>
            <p class="text-muted small mb-0">Kelola kategori sarana dan prasarana sekolah</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
        </button>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 border-0 py-3" width="10%">ID</th>
                            <th class="border-0 py-3">Keterangan Kategori</th>
                            <th class="text-end pe-4 border-0 py-3" width="15%">Aksi</th>
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
                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection