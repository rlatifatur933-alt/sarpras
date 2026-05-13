@extends('layouts.siswa_app')

@section('content')

<style>
    .card {
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08) !important;
        max-width: 550px; 
        margin: 20px auto !important; 
        overflow: hidden;
    }

    .card-header-custom {
        background: #f8f9fc;
        padding: 25px 20px;
        text-align: center;
        border-bottom: 1px solid #e3e6f0;
    }

    h3 {
        color: #4e73df;
        font-weight: 800 !important;
        font-size: 1.4rem;
        margin-bottom: 5px;
    }

    .form-group-custom {
        padding: 25px;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.75rem;
        color: #4e73df;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }

    .form-control, .form-select {
        border-radius: 12px !important;
        padding: 12px 15px !important;
        border: 1.5px solid #d1d3e2 !important;
        background-color: #fff !important;
        font-size: 0.9rem !important;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
    }

    input[readonly] {
        background-color: #f8f9fc !important;
        border-color: #eaecf4 !important;
        color: #b7b9cc;
    }

    .btn-primary {
        background: #4e73df !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 14px !important;
        font-weight: 700 !important;
        width: 100%;
        margin-top: 10px;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.2) !important;
    }

    .btn-primary:hover {
        background: #224abe !important;
        transform: translateY(-1px);
    }

    .btn-link {
        color: #858796 !important;
        font-size: 0.85rem;
        text-decoration: none !important;
        display: block;
        margin-top: 15px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center mb-1">Kirim Aspirasi</h3>
                <div class="title-underline"></div>
                <p class="text-muted text-center small">Laporkan kerusakan sarana prasarana sekolah di sini.</p>
                <hr>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    
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

                    <select name="lokasi" class="form-select" required>
                        <option value="" selected disabled>-- Pilih lokasi --</option>
                        
                        {{-- Ini bagian yang bikin otomatis nyambung ke data Admin --}}
                        @foreach($lokasi as $l)
                            <option value="{{ $l->nama_lokasi }}">{{ $l->nama_lokasi }}</option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label class="form-label">Foto Bukti Kerusakan</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <small class="text-muted">Format: jpg, png, jpeg. Maks: 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Laporan / Aspirasi</label>
                        <textarea name="ket" class="form-control" rows="4" placeholder="Jelaskan detail kerusakannya..." required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Kirim Sekarang</button>
                        <a href="{{ route('aspirasi.history') }}" class="btn btn-light text-muted">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection