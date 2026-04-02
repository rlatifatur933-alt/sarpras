<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Aspirasi - Sarprasin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f0f5ff; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(67, 94, 190, 0.1); }
        .btn-mazer { background-color: #435ebe; color: white; font-weight: 700; border-radius: 8px; }
        .btn-mazer:hover { background-color: #25396f; color: white; }
        .text-mazer { color: #435ebe; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-mazer">Kirim Aspirasi Baru</h2>
                    <p class="text-muted">Isi formulir di bawah untuk melaporkan saran atau kerusakan.</p>
                </div>
                <div class="card p-4">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIS Anda</label>
                            <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori_id" class="form-select">
                                <option value="">Pilih Kategori Sarana</option>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Laporan/Aspirasi</label>
                            <textarea name="laporan" class="form-control" rows="4" placeholder="Ceritakan detailnya..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-mazer w-full py-2 mt-2">Kirim Sekarang</button>
                        <a href="{{ url('/') }}" class="btn btn-link w-full text-center mt-3 text-decoration-none text-muted">Kembali ke Beranda</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>