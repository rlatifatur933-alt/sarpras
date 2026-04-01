@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <h5 class="mb-0">Data Master Siswa & Akun</h5>
            <a href="#" class="btn btn-primary btn-sm">Tambah Siswa</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr>
                        <td>{{ $s->username }}</td>
                        <td>{{ $s->user->email ?? 'N/A' }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->kelas }}</td>
                        <td><span class="badge bg-info text-dark">{{ $s->user->role ?? 'siswa' }}</span></td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection