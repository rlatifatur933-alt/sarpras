@extends('layouts.siswa_app')

@section('content')
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

                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
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