@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Data Siswa</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Akun & Email Siswa</h4>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->username }}</td> 
                            <td>{{ $s->user->email ?? 'Email tidak ditemukan' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->user_id }}">
                                    <i class="bi bi-pencil"></i> Ganti Email
                                </button>
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
                                            <div class="form-group">
                                                <label>Email Baru</label>
                                                <input type="email" name="email" class="form-control" value="{{ $s->user->email ?? '' }}" required>
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
            </div>
        </div>
    </section>
</div>
@endsection

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