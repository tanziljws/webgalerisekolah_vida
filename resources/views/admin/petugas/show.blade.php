@extends('layouts.admin')

@section('title', 'Detail Petugas - Admin SMKN 4 BOGOR')
@section('page-title', 'Detail Petugas')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Petugas</h5>
                    <div>
                        <a href="{{ route('admin.petugas.edit', $petugas) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $petugas->username }}</h3>
                            <p class="text-muted">Dibuat pada {{ $petugas->created_at ? $petugas->created_at->format('d M Y H:i') : '-' }}</p>
                            
                            @if($petugas->posts->count() > 0)
                                <h5 class="mt-4">Posts yang dibuat:</h5>
                                <div class="list-group">
                                    @foreach($petugas->posts as $post)
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $post->judul }}</h6>
                                            <small>{{ $post->created_at ? $post->created_at->format('d M Y') : '-' }}</small>
                                        </div>
                                        <p class="mb-1">{{ \Illuminate\Support\Str::limit($post->isi, 100) }}</p>
                                        <small>
                                            Kategori: <span class="badge bg-info">{{ $post->kategori ? $post->kategori->judul : 'Tidak ada kategori' }}</span>
                                            Status: 
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
                                    Petugas ini belum membuat posts.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Informasi Petugas</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Username:</strong> {{ $petugas->username }}</p>
                                    <p><strong>Total Posts:</strong> {{ $petugas->posts->count() }}</p>
                                    <p><strong>Dibuat:</strong> {{ $petugas->created_at ? $petugas->created_at->format('d M Y H:i') : '-' }}</p>
                                    <p><strong>Diupdate:</strong> {{ $petugas->updated_at ? $petugas->updated_at->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
