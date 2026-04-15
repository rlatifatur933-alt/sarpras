@section('content')
<div class="container mt-4">
    <div class="col-md-6 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h5>Form Pengaduan Aspirasi</h5>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
                @csrf
                <div class="mb-3">
                    <label>Pilih Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        @foreach($kategori as $k)
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
                    <label>Isi Laporan</label>
                    <textarea name="ket" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Upload Foto Kejadian</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
            </form>
        </div>
    </div>
</div>
@endsection