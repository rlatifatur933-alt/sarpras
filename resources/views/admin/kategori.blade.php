@extends('layouts.app') {{-- Asumsi kamu pakai layout utama --}}

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Kategori Aspirasi</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Keterangan Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                    <tr>
                        <td>{{ $k->id_kategori }}</td>
                        <td>{{ $k->ket_kategori }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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