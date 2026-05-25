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

<div class="page-content">
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Data Pengaduan Sarana</h2>
            <p class="text-muted mb-0">Manajemen Pengaduan Sarana dan Prasarana</p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2 flex-wrap m-0 bg-white p-2 rounded-3 shadow-sm border">
                <input 
                    type="date" 
                    name="tanggal" 
                    class="form-control border-0 bg-light" 
                    value="{{ request('tanggal') }}"
                    style="width: 160px; border-radius: 6px; font-size: 14px;"
                >

                <select name="status_filter" class="form-select border-0 bg-light" style="width: 150px; border-radius: 6px; font-size: 14px;">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status_filter') == 'menunggu' ? 'selected' : '' }}> Menunggu</option>
                    <option value="proses" {{ request('status_filter') == 'proses' ? 'selected' : '' }}> Proses</option>
                    <option value="selesai" {{ request('status_filter') == 'selesai' ? 'selected' : '' }}> Selesai</option>
                </select>

                <input 
                    type="text" 
                    name="search" 
                    class="form-control border-0 bg-light" 
                    placeholder="Cari laporan/lokasi..." 
                    value="{{ request('search') }}"
                    style="width: 200px; border-radius: 6px; font-size: 14px;"
                >

                <button type="submit" class="btn btn-primary px-3 fw-semibold" style="border-radius: 6px; font-size: 14px;">
                    <i class="bi bi-search me-1"></i> Cari
                </button>

                @if(request('search') || request('tanggal') || request('status_filter'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary fw-semibold" style="border-radius: 6px; font-size: 14px;">
                        Reset
                    </a>
                @endif
            </form>

            <button type="button" class="btn btn-success fw-bold d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalExportExcel" style="border-radius: 8px; padding: 9px 18px; font-size: 14px;">
                <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="table1">
                    <thead class="bg-light text-secondary text-uppercase font-monospace" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3">TANGGAL</th>
                            <th class="py-3">KATEGORI</th>
                            <th class="py-3">LOKASI</th>
                            <th class="py-3 text-center">FOTO</th>
                            <th class="py-3 text-center">STATUS</th>
                            <th class="pe-4 py-3 text-center">AKSI</th> 
                        </tr>
                    </thead>
                    <tbody class="text-dark" style="font-size: 14px;">
                        @foreach($laporan as $row)
                        <tr style="transition: all 0.2s ease;">
                            <td class="ps-4 py-3 fw-medium text-secondary">
                                {{ $row->created_at->format('d/m/Y') }}
                            </td>

                            <td class="py-3">
                                <span class="fw-bold text-dark d-block">{{ $row->kategori->ket_kategori ?? 'N/A' }}</span>
                                <small class="text-muted d-block text-truncate" style="max-width: 180px;">{{ $row->ket }}</small>
                            </td>

                            <td class="py-3 fw-semibold text-secondary">
                                <i class="bi bi-geo-alt text-danger me-1"></i>{{ $row->lokasi }}
                            </td>

                            <td class="py-3 text-center">
                                @if($row->foto && $row->foto != 'default.png')
                                    <img src="{{ asset('uploads/aspirasi/' . $row->foto) }}" 
                                         class="rounded-3 object-fit-cover shadow-sm border" 
                                         style="width: 52px; height: 52px; transition: transform 0.2s;"
                                         alt="Foto Laporan"
                                         onmouseover="this.style.transform='scale(1.1)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                @else
                                    <span class="badge bg-light text-muted fw-normal" style="font-size: 12px;">No Photo</span>
                                @endif
                            </td>

                            <td class="py-3 text-center">
                                @if($row->aspirasi)
                                    @php $status = $row->aspirasi->status; @endphp
                                    @if($status == 'menunggu')
                                        <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: #fff3cd; color: #856404; font-size: 11px; letter-spacing: 0.5px;">
                                             MENUNGGU
                                        </span>
                                    @elseif($status == 'proses')
                                        <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: #e2f0fe; color: #0d6efd; font-size: 11px; letter-spacing: 0.5px;">
                                             PROSES
                                        </span>
                                    @else
                                        <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: #d1e7dd; color: #0f5132; font-size: 11px; letter-spacing: 0.5px;">
                                             SELESAI
                                        </span>
                                    @endif
                                @else
                                    <span class="badge px-3 py-2 rounded-pill bg-light text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">
                                        Belum Dicek
                                    </span>
                                @endif
                            </td>

                            <td class="pe-4 py-3 text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <a href="{{ url('/admin/detail/' . $row->id_pelaporan) }}" class="btn btn-sm btn-light text-secondary border-0 rounded-2 p-2" title="Detail Laporan" style="background-color: #f0f4f8;">
                                        <i class="bi bi-eye-fill fs-6 text-muted"></i>
                                    </a>

                                    <button class="btn btn-sm btn-light text-primary border-0 rounded-2 p-2" style="background-color: #e6f0ff;" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id_pelaporan }}" title="Update Status">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </button>

                                    <form action="{{ route('aspirasi.destroy', $row->id_pelaporan) }}" method="POST" class="m-0 d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border-0 rounded-2 p-2" style="background-color: #ffebe6;" onclick="return confirm('Yakin hapus?')" title="Hapus Laporan">
                                            <i class="bi bi-trash3-fill fs-6"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $row->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
                                    <form action="{{ route('aspirasi.update', $row->id_pelaporan) }}" method="POST">
                                        @csrf
                                        <div class="modal-header text-white px-4" style="background: linear-gradient(45deg, #1d3557, #457b9d); border-top-left-radius: 14px; border-top-right-radius: 14px;">
                                            <h5 class="modal-title fs-6"><i class="bi bi-pencil-fill me-2"></i> Update Status & Feedback</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3 text-start">
                                                <label class="form-label fw-bold text-secondary mb-2" style="font-size: 13px;">Set Status</label>
                                                <select name="status" class="form-select border-2" style="border-radius: 8px;">
                                                    <option value="menunggu" {{ ($row->aspirasi->status ?? '') == 'menunggu' ? 'selected' : '' }}>PENDING (Menunggu)</option>
                                                    <option value="proses" {{ ($row->aspirasi->status ?? '') == 'proses' ? 'selected' : '' }}>IN PROGRESS (Proses)</option>
                                                    <option value="selesai" {{ ($row->aspirasi->status ?? '') == 'selesai' ? 'selected' : '' }}>DONE (Selesai)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label class="form-label fw-bold text-secondary mb-2" style="font-size: 13px;">Tanggapan Admin</label>
                                                <textarea name="feedback" class="form-control border-2" rows="4" style="border-radius: 8px;" placeholder="Tulis instruksi tindak lanjut di sini...">{{ $row->aspirasi->feedback ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light px-4 py-3" style="border-bottom-left-radius: 14px; border-bottom-right-radius: 14px;">
                                            <button type="submit" class="btn btn-primary w-100 fw-bold" style="border-radius: 8px; padding: 10px;">SIMPAN PERUBAHAN</button>
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
    </div>
</div>

<div class="modal fade" id="modalExportExcel" tabindex="-1" aria-labelledby="modalExportExcelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header px-4">
                <h5 class="modal-title fw-bold text-dark fs-6" id="modalExportExcelLabel"><i class="bi bi-file-earmark-excel-fill text-success me-2"></i>Export Laporan Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.aspirasi.export') }}" method="GET">
                <div class="modal-body p-4">
                    <div class="mb-3 form-check bg-light p-3 rounded-3 border">
                        <input type="checkbox" class="form-check-input" id="exportSemua" name="export_semua" style="margin-left: 0px; cursor: pointer;">
                        <label class="form-check-label fw-bold text-success" for="exportSemua" style="margin-left: 20px; cursor: pointer;">
                            Export Keseluruhan Data
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary fw-semibold small">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggalMulai" class="form-control" style="border-radius: 8px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary fw-semibold small">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggalSelesai" class="form-control" style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-secondary fw-semibold small">Status</label>
                        <select name="status" class="form-select" style="border-radius: 8px;">
                            <option value="Semua Status">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4">
                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold px-4" style="border-radius: 8px;">Export Excel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logic otomatis modal export excel bawaan kamu
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