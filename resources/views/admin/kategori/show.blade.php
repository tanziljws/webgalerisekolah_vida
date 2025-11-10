@extends('layouts.admin')

@section('title', 'Detail Kategori - Admin SMKN 4 BOGOR')
@section('page-title', 'Detail Kategori')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Kategori</h5>
                    <div>
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $kategori->judul }}</h3>
                            <p class="text-muted">Dibuat pada {{ $kategori->created_at->format('d M Y H:i') }}</p>
                            
                            @if($kategori->posts->count() > 0)
                                <h5 class="mt-4">Posts dalam kategori ini:</h5>
                                <div class="list-group">
                                    @foreach($kategori->posts as $post)
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $post->judul }}</h6>
                                            <small>{{ $post->created_at->format('d M Y') }}</small>
                                        </div>
                                        <p class="mb-1">{{ Str::limit($post->isi, 100) }}</p>
                                        <small>Status: 
                                            <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                        </small>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada posts dalam kategori ini.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Informasi Kategori</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Total Posts:</strong> {{ $kategori->posts->count() }}</p>
                                    <p><strong>Dibuat:</strong> {{ $kategori->created_at->format('d M Y H:i') }}</p>
                                    <p><strong>Diupdate:</strong> {{ $kategori->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
