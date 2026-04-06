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
                <table class="table table-hover align-middle" id="table1">
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
                            <td class="text-center text-muted">{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $row->kategori->ket_kategori ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $row->ket }}</small>
                            </td>
                            <td>{{ $row->lokasi }}</td>
                            <td>{{ $row->siswa->nama ?? 'Anonim' }}</td>
                            <td class="text-center">
                                @if($row->aspirasi)
                                    @if($row->aspirasi->status == 'menunggu')
                                        <span class="badge rounded-pill bg-danger">Pending</span>
                                    @elseif($row->aspirasi->status == 'proses')
                                        <span class="badge rounded-pill bg-warning text-dark">In Progress</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Done</span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill bg-secondary text-white">Belum Ada Status</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $row->id_pelaporan }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <div class="modal fade" id="modalUpdate{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">Update Laporan #{{ $row->id_pelaporan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start text-dark">
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>Pending</option>
                                                            <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>In Progress</option>
                                                            <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold text-dark">Feedback Admin</label>
                                                        <textarea name="feedback" class="form-control" rows="3">{{ $row->aspirasi->feedback ?? '' }}</textarea>
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