@extends('layouts.admin')

@section('title', 'Detail Galeri - Admin SMKN 4 BOGOR')
@section('page-title', 'Detail Galeri')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Galeri</h5>
                    <div>
                        <a href="{{ route('admin.galery.edit', $galery) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.galery.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Galeri untuk: {{ $galery->post->judul }}</h3>
                            <p class="text-muted">
                                Position: {{ $galery->position }} | 
                                Status: 
                                <span class="badge bg-{{ (int)$galery->status === 1 ? 'success' : 'secondary' }}">
                                    {{ (int)$galery->status === 1 ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </p>
                            
                            @if($galery->fotos->count() > 0)
                                <h5 class="mt-4">Foto dalam galeri ini:</h5>
                                <div class="row">
                                    @foreach($galery->fotos as $foto)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ Storage::url($foto->file) }}" class="card-img-top" alt="{{ $foto->judul }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $foto->judul }}</h6>
                                                <small class="text-muted">{{ $foto->created_at->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada foto dalam galeri ini.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Informasi Galeri</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Post:</strong> {{ $galery->post->judul }}</p>
                                    <p><strong>Position:</strong> {{ $galery->position }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge bg-{{ $galery->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($galery->status) }}
                                        </span>
                                    </p>
                                    <p><strong>Total Foto:</strong> {{ $galery->fotos->count() }}</p>
                                    <p><strong>Dibuat:</strong> {{ $galery->created_at->format('d M Y H:i') }}</p>
                                    <p><strong>Diupdate:</strong> {{ $galery->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
