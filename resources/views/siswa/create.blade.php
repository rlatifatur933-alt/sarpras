@extends('layouts.siswa_app') {{-- Agar sidebar otomatis muncul --}}

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Kotak putih besar melengkung (Card) --}}
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Kirim Aspirasi</h3>
                    <p class="text-muted small">Laporkan kerusakan sarana prasarana sekolah di sini agar segera ditindaklanjuti.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary small">NIS Pelapor</label>
                                {{-- Gunakan variable $siswa dari Controller --}}
                                <input type="number" name="nis" class="form-control bg-light" value="{{ $siswa->nis }}" readonly>
                                <small class="text-muted italic" style="font-size: 11px;">*NIS terisi otomatis</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary small">Kategori Kerusakan</label>
                                <select name="id_kategori" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary small">Lokasi Kejadian</label>
                                <select name="lokasi" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Lokasi --</option>
                                    @foreach($lokasi as $l)
                                       <option value="{{ $l->nama_lokasi }}">{{ $l->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary small">Isi Laporan / Detail Kerusakan</label>
                                <textarea name="ket" class="form-control" rows="5" placeholder="Contoh: AC di ruang kelas XII RPL 1 mengeluarkan bunyi bising dan tidak dingin..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary small">Upload Foto Bukti</label>
                                <input type="file" name="foto" class="form-control" required>
                                <small class="text-muted" style="font-size: 11px;">Pastikan foto terlihat jelas.</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; background-color: #4e73df;">
                            <i class="bi bi-send me-2"></i>Kirim Laporan Sekarang
                        </button>
                        <a href="{{ route('aspirasi.history') }}" class="btn btn-link text-muted text-decoration-none small">Kembali ke Riwayat</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection