@extends('layouts.app') 
@section('content')
<div class="page-heading">
    <h3 class="fw-bold">Data Pengaduan Sarana</h3>
    <p class="text-muted">Manajemen Pengaduan Sarana dan Prasarana</p>
</div>

<div class="page-content">
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>TANGGAL</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th>NAMA SISWA</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $row)
                        <tr>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <strong>{{ $row->kategori->ket_kategori ?? 'N/A' }}</strong>
                                <br><small class="text-muted">{{ $row->ket }}</small>
                            </td>
                            <td>{{ $row->lokasi }}</td>
                            <td>{{ $row->siswa->nama ?? 'Anonim' }}</td>
                            <td>
                                @if($row->aspirasi->status == 'menunggu')
                                    <span class="badge bg-light-danger text-danger">● Pending</span>
                                @elseif($row->aspirasi->status == 'proses')
                                    <span class="badge bg-light-warning text-warning">● In Progress</span>
                                @else
                                    <span class="badge bg-light-success text-success">● Done</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-success"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection