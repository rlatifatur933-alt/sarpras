@extends('layouts.app') 
@section('content')
<style>
    .page-heading h2 {
        color: #25396f !important;
        font-weight: 800 !important;
        font-size: 2.2rem !important;
        letter-spacing: -1px !important;
    }

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

    .info-label {
        color: #435ebe;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .info-value {
        color: #111; 
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

    @media (min-width: 992px) {
        .modal-custom-full {
            max-width: calc(100% - 300px) !important;
            margin-left: auto !important;
            margin-right: 20px !important;
        }
        
        .modal-content {
            border-radius: 20px !important;
            border: none !important;
        }
    }

    .img-detail-modal {
        height: 300px !important;
        object-fit: cover;
        border-radius: 15px;
    }
</style>

<div class="page-heading d-flex justify-content-between align-items-center">
    <div>
        <h2>Data Pengaduan Sarana</h2>
        <p>Manajemen Pengaduan Sarana dan Prasarana</p>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExportExcel">
            Export Excel
        </button>
    </div>
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
                                    @php $status = $row->aspirasi->status; @endphp
                                    <span class="badge rounded-pill {{ $status == 'menunggu' ? 'status-pending' : ($status == 'proses' ? 'status-progress' : 'status-done') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-light text-muted">Belum Dicek</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <a href="{{ url('/admin/detail/' . $row->id_pelaporan) }}" class="btn p-0 border-0">
                                        <i class="bi bi-eye text-secondary fs-5"></i>
                                    </a>

                                    <button class="btn p-0 border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id_pelaporan }}">
                                        <i class="bi bi-pencil-square text-primary fs-5"></i>
                                    </button>

                                    <form action="{{ route('aspirasi.destroy', $row->id_pelaporan) }}" method="POST" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0" onclick="return confirm('Yakin hapus?')">
                                            <i class="bi bi-trash3 text-danger fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                        @csrf
                                        <div class="modal-header" style="background: linear-gradient(45deg, #1d3557, #457b9d);">
                                            <h5 class="modal-title"><i class="bi bi-pencil-fill me-2"></i> Update Status & Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3 text-start">
                                                <label class="form-label-custom">Set Status</label>
                                                <select name="status" class="form-select border-2">
                                                    <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>PENDING</option>
                                                    <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>IN PROGRESS</option>
                                                    <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>DONE</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label class="form-label-custom">Tanggapan Admin</label>
                                                <textarea name="feedback" class="form-control border-2" rows="4">{{ $row->aspirasi->feedback ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="submit" class="btn btn-primary w-100 fw-bold">SIMPAN PERUBAHAN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
    
                @foreach($laporan as $row)
                    <div class="modal fade" id="detailModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-custom-full modal-dialog-centered">
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
<div class="modal fade" id="modalExportExcel" tabindex="-1" aria-labelledby="modalExportExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExportExcelLabel">Export Laporan Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.aspirasi.export') }}" method="GET">
                <div class="modal-body">
                    
                    <div class="mb-3 form-check bg-light p-3 rounded">
                        <input type="checkbox" class="form-check-input" id="exportSemua" name="export_semua" style="margin-left: 0px; cursor: pointer;">
                        <label class="form-check-label fw-bold text-success" for="exportSemua" style="margin-left: 20px; cursor: pointer;">
                            Export Keseluruhan Data
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-dark">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggalMulai" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-dark">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggalSelesai" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark">Status</label>
                        <select name="status" class="form-control">
                            <option value="Semua Status">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Export Excel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logic otomatis: kalau checkbox dicentang, input tanggal otomatis disabled
    document.getElementById('exportSemua').addEventListener('change', function() {
        var tglMulai = document.getElementById('tanggalMulai');
        var tglSelesai = document.getElementById('tanggalSelesai');
        
        if(this.checked) {
            tglMulai.disabled = true;
            tglSelesai.disabled = true;
            tglMulai.value = '';
            tglSelesai.value = '';
        } else {
            tglMulai.disabled = false;
            tglSelesai.disabled = false;
        }
    });
</script>
@endsection