@extends('layouts.petugas')

@section('title', 'Edit Foto - Petugas SMKN 4 BOGOR')
@section('page-title', 'Edit Foto')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Edit Foto</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.foto.update', $foto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="galery_id" class="form-label">Galeri</label>
                                    <select class="form-select @error('galery_id') is-invalid @enderror" 
                                            id="galery_id" name="galery_id" required>
                                        <option value="">Pilih Galeri</option>
                                        @foreach($galeries as $galery)
                                            <option value="{{ $galery->id }}" 
                                                    {{ old('galery_id', $foto->galery_id) == $galery->id ? 'selected' : '' }}>
                                                {{ $galery->post->judul }} (Posisi: {{ $galery->position }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('galery_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Foto</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" name="judul" value="{{ old('judul', $foto->judul) }}" 
                                           placeholder="Masukkan judul foto" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File Foto (opsional - kosongkan jika tidak ingin mengganti)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file" accept="image/*">
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            @if($foto->file && file_exists(public_path('images/gallery/' . $foto->file)))
                                <div class="card" style="max-width: 300px;">
                                    <img src="{{ asset('images/gallery/' . $foto->file) }}" class="card-img-top" alt="{{ $foto->judul }}" style="height: 200px; object-fit: cover;">
                                </div>
                            @else
                                <p class="text-muted">File tidak ditemukan</p>
                            @endif
                        </div>

                        <div id="preview" class="mb-3"></div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('petugas.foto.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('file').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <label class="form-label">Preview Foto Baru</label>
                <div class="card" style="max-width: 300px;">
                    <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text small mb-0">Preview: ${file.name}</p>
                    </div>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
});
</script>
@endpush
