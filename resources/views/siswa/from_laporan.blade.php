<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Aspirasi - SARPRASIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #4e73df; border: none; }
        .btn-primary:hover { background-color: #2e59d9; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center mb-4" style="color: #4e73df; font-weight: bold;">Kirim Aspirasi</h3>
                <p class="text-muted text-center">Laporkan kerusakan sarana prasarana sekolah di sini.</p>
                <hr>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('aspirasi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">nis</label>
                        <input type="number" name="nis" class="form-control" placeholder="Masukkan nis kamu" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Kerusakan</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            
                            @foreach($kategori as $k)
                                {{-- Pakai ket_kategori karena itu nama kolom di database kamu --}}
                                <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <select name="lokasi" class="form-select" required>
                            <option value="">-- Pilih lokasi --</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Kamar Mandi">Kamar Mandi</option>
                            <option value="Lab">Lab</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Laporan / Aspirasi</label>
                        <textarea name="ket" class="form-control" rows="4" placeholder="Jelaskan detail kerusakannya..." required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Kirim Sekarang</button>
                        <a href="/" class="btn btn-light text-muted">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>