@extends('layouts.admin')

@section('title', 'Edit Galeri - Admin SMKN 4 BOGOR')
@section('page-title', 'Edit Galeri')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Edit Galeri</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.galery.update', $galery) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="post_id" class="form-label">Post</label>
                                    <select class="form-select @error('post_id') is-invalid @enderror" 
                                            id="post_id" name="post_id" required>
                                        <option value="">Pilih Post</option>
                                        @foreach($posts as $post)
                                            <option value="{{ $post->id }}" 
                                                    {{ old('post_id', $galery->post_id) == $post->id ? 'selected' : '' }}>
                                                {{ $post->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('post_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="number" class="form-control @error('position') is-invalid @enderror" 
                                           id="position" name="position" value="{{ old('position', $galery->position) }}" 
                                           placeholder="Masukkan posisi galeri" min="1" required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status', (string)$galery->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', (string)$galery->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.galery.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
