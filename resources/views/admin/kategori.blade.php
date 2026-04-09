@extends('layouts.app') {{-- Asumsi kamu pakai layout utama --}}

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid py-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="fw-bold mb-0">Daftar Kategori Aspirasi</h4>
            <p class="text-muted small">Kelola kategori sarana dan prasarana sekolah</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('kategori.store') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="10%">ID</th>
                            <th>Keterangan Kategori</th>
                            <th class="text-end pe-4" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $k)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill">
                                    #{{ $k->id_kategori }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box me-3 bg-primary-subtle rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bi bi-tag-fill text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block">{{ $k->ket_kategori }}</span>
                                        <small class="text-muted">Aktif digunakan</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-3 px-3 py-2" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('kategori.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5>Tambah Kategori</h5></div>
            <div class="modal-body">
                <input type="text" name="ket_kategori" class="form-control" placeholder="Nama Kategori" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection