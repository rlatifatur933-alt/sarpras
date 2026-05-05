@extends('layouts.app')

@section('content')
<style>
    .page-title {
        font-weight: 800;
        color: #25396f; 
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .page-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        height: 4px;
        width: 40px;
        background: #435ebe; 
        border-radius: 10px;
    }

    #table1 thead th {
        background-color: #435ebe; 
        color: white;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    #table1 tbody tr:hover {
        background-color: #f0f3ff !important;
        transition: 0.3s;
    }

    #table1 td, #table1 th {
        padding: 12px 15px !important;
    }

    .icon-navy {
        color: #000080 !important; 
    }
</style>
<div class="d-flex align-items-center mb-4">
    <div class="stats-icon me-3 shadow-sm" style="width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; background-color: rgba(0, 0, 128, 0.1); border-radius: 12px;">
        <i class="bi bi-people-fill icon-navy fs-4"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-0">Data Siswa</h3>
        <span class="text-muted">Total Siswa Terdaftar: <b>{{ $siswa->count() }}</b></span>
    </div>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Akun & Email Siswa</h4>

            <div style="width: 250px;">
                <input type="text" id="inputCari" class="form-control form-control-sm" placeholder="Cari email atau nama...">
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
                <i class="bi bi-plus-circle"></i> Tambah Siswa
            </button>

        </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Email (Akun)</th>
                            <th class="text-center pe-4 border-0 py-3" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->username }}</td> 
                            <td>{{ $s->user->email ?? 'Email tidak ditemukan' }}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-warning d-flex align-items-center" style="height: 32px; min-width: 80px; justify-content: center;" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->user_id }}">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>

                                    <form action="{{ route('siswa.destroy', $s->user_id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center" style="height: 32px; min-width: 80px; justify-content: center;">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $s->user_id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('siswa.update', $s->user_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Email Siswa</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label>Nama Siswa</label>
                                                <input type="text" name="username" class="form-control" value="{{ $s->username }}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label>NIS</label>
                                                <input type="text" name="nis" class="form-control" value="{{ $s->nis }}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label>Email Akun</label>
                                                <input type="email" name="email" class="form-control" value="{{ $s->user->email ?? '' }}" required>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label>Password Baru (Kosongkan jika tidak ingin ganti)</label>
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    document.getElementById('inputCari').addEventListener('keyup', function() {
                        let filter = this.value.toLowerCase();
                        let rows = document.querySelectorAll('#table1 tbody tr');

                        rows.forEach(row => {
                            let nama = row.cells[2].textContent.toLowerCase();
                            let email = row.cells[3].textContent.toLowerCase();

                            if (nama.includes(filter) || email.includes(filter)) {
                                row.style.display = "";
                            } else {
                                row.style.display = "none"; 
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="tambahSiswa" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Pendaftaran Siswa Baru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection