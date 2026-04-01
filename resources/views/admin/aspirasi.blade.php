@section('content')
<div class="container mt-4">
    <h5>Manajemen Tanggapan Aspirasi</h5>
    <div class="row">
        @foreach($data as $a)
        <div class="col-md-4 mb-3">
            <div class="card border-{{ $a->status == 'selesai' ? 'success' : 'warning' }}">
                <div class="card-body">
                    <small class="text-muted">Pelapor: {{ $a->inputAspirasi->siswa->username }} ({{ $a->inputAspirasi->siswa->kelas }})</small>
                    <p><strong>{{ $a->inputAspirasi->kategori->ket_kategori }}</strong></p>
                    <p>{{ $a->inputAspirasi->ket }}</p>
                    <hr>
                    <form action="{{ route('admin.aspirasi.update', $a->id_aspirasi) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-2">
                            <label>Status:</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="menunggu" {{ $a->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="proses" {{ $a->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Feedback Admin:</label>
                            <textarea name="feedback" class="form-control form-control-sm">{{ $a->feedback }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm w-100">Simpan Tanggapan</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection