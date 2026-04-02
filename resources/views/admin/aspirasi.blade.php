@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Manajemen Laporan Kerusakan</h2>
            <p class="text-muted">Daftar aspirasi dan keluhan fasilitas dari siswa.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 style="color: #435ebe;"></h3>
                <p class="text-subtitle text-muted"></p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Data Laporan</h4>
                <button class="btn btn-sm btn-outline-primary">View all</button>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>SISWA</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $row->siswa->username ?? 'Siswa' }}</td>
                            <td>{{ $row->kategori->nama_kategori ?? 'Umum' }}</td>
                            <td><span class="badge bg-light-secondary text-secondary">Lab 1 RPL</span></td>
                            <td>
                                @if($row->status == 'menunggu')
                                    <span class="badge bg-light-warning text-warning text-uppercase">Pending</span>
                                @elseif($row->status == 'proses')
                                    <span class="badge bg-light-info text-info text-uppercase">In Progress</span>
                                @else
                                    <span class="badge bg-light-success text-success text-uppercase">Done</span>
                                @endif
                            </td>
                            <td>{{ $row->created_at->format('d M, H:i') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" style="border-radius: 8px;">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>
@endsection