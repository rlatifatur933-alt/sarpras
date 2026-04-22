@extends('layouts.app') 
@section('content')
<style>
    /* Header Styling */
    .page-heading h2 {
        color: #25396f !important;
        font-weight: 800 !important;
        font-size: 2.2rem !important;
        letter-spacing: -1px !important;
    }

    /* Table Styling */
    .table thead th {
        background-color: #f8f9fa;
        color: #435ebe;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        font-weight: 700;
        border: none;
    }

    .table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        border-radius: 10px;
        transition: transform 0.2s;
    }

    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .modal-header {
        background: linear-gradient(45deg, #435ebe, #5a73d8);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }

    .modal-header .modal-title, .modal-header .btn-close {
        color: white !important;
        filter: brightness(0) invert(1);
    }

    /* Kontras Teks Modal */
    .info-label {
        color: #435ebe;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .info-value {
        color: #111; /* Hitam pekat agar jelas */
        font-weight: 600;
        font-size: 1rem;
    }

    .info-box {
        background-color: #f0f3ff;
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #dce1f5;
        color: #222;
        font-size: 0.95rem;
    }

    .form-label-custom {
        color: #25396f;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .btn-save {
        background: #435ebe;
        border: none;
        font-weight: 700;
        padding: 10px 25px;
        border-radius: 10px;
    }

    .badge {
        padding: 8px 16px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
    }
    .status-pending { background-color: #ffe5e5; color: #ff4a4a; }
    .status-progress { background-color: #fff4e5; color: #ff9f43; }
    .status-done { background-color: #e5f9f6; color: #28c76f; }
</style>

<div class="page-heading">
    <h2>Data Pengaduan Sarana</h2>
    <p>Manajemen Pengaduan Sarana dan Prasarana</p>
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
                            <th>FOTO</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">AKSI</th> 
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($laporan as $row)
                        <tr>
                            <td class="text-muted align-middle ps-3">{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $row->kategori->ket_kategori ?? 'N/A' }}</div>
                                <small class="text-muted text-truncate" style="max-width: 150px; display: block;">{{ $row->ket }}</small>
                            </td>
                            <td>{{ $row->lokasi }}</td>
                            <td>
                                @if($row->foto && $row->foto != 'default.png')
                                    <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">No Photo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($row->aspirasi)
                                    @if($row->aspirasi->status == 'menunggu')
                                        <span class="badge rounded-pill status-pending">Pending</span>
                                    @elseif($row->aspirasi->status == 'proses')
                                        <span class="badge rounded-pill status-progress">In Progress</span>
                                    @else
                                        <span class="badge rounded-pill status-done">Done</span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill bg-light text-muted">Belum Dicek</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- Tombol Edit dihapus, semua pindah ke Detail --}}
                                <button class="btn btn-info btn-sm text-white px-3" data-bs-toggle="modal" data-bs-target="#detailModal{{ $row->id_pelaporan }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    
                @foreach($laporan as $row)
                    <div class="modal fade" id="detailModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="bi bi-info-circle-fill me-2"></i> Detail & Update Laporan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="info-label">Foto Bukti</span>
                                                <div class="position-relative mb-4">
                                                    <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" class="img-fluid rounded-4 shadow-sm border" style="width: 100%; height: 200px; object-fit: cover;">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <span class="info-label">Nama Pelapor</span>
                                                    <div class="info-value">{{ $row->siswa->username ?? 'Anonym' }}</div>
                                                </div>

                                                <div class="mb-3">
                                                    <span class="info-label">Keterangan Siswa</span>
                                                    <div class="info-box shadow-sm">
                                                        {{ $row->ket }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="info-label">Tanggal Masuk Laporan</span>
                                                    <div class="info-value">
                                                        <i class="bi bi-calendar3 me-1"></i> {{ $row->created_at->format('d F Y') }} 
                                                        <small class="text-muted">({{ $row->created_at->format('H:i') }} WIB)</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-7 border-start ps-md-4">
                                                <div class="mb-4">
                                                    <label class="form-label-custom"><i class="bi bi-flag-fill me-1"></i> Status Laporan</label>
                                                    <select name="status" class="form-select form-select-lg border-2 shadow-sm" style="font-weight: 600; color: #435ebe;">
                                                        <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>PENDING (Menunggu)</option>
                                                        <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>IN PROGRESS (Proses)</option>
                                                        <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>DONE (Selesai)</option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label-custom"><i class="bi bi-chat-left-dots-fill me-1"></i> Tanggapan Admin</label>
                                                    <textarea name="feedback" class="form-control border-2 shadow-sm" rows="4" placeholder="Berikan instruksi atau update ke siswa..." style="font-size: 0.95rem; color: #111;">{{ $row->aspirasi->feedback ?? '' }}</textarea>
                                                </div>

                                                {{-- Area Hapus khusus Done --}}
                                                @if(($row->aspirasi->status ?? '') == 'selesai')
                                                    <div class="alert alert-light-danger border-danger border-1 d-flex flex-column gap-2 py-3" style="border-style: dashed !important; border-radius: 12px;">
                                                        <span class="text-danger fw-bold small"><i class="bi bi-trash3-fill"></i> HAPUS DATA PERMANEN?</span>
                                                        <button type="button" class="btn btn-danger btn-sm w-100 fw-bold shadow-sm" onclick="if(confirm('Wahyu, yakin ingin menghapus laporan ini? Data akan hilang selamanya.')) { document.getElementById('delete-form-{{ $row->id_pelaporan }}').submit(); }">
                                                            YA, HAPUS SEKARANG
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light p-3">
                                        <button type="button" class="btn btn-light-secondary fw-bold px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-save shadow text-white px-5">SIMPAN PERUBAHAN</button>
                                    </div>
                                </form>

                                <form id="delete-form-{{ $row->id_pelaporan }}" action="{{ route('aspirasi.destroy', $row->id_pelaporan) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection