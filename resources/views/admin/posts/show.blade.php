@extends('layouts.admin')

@section('title', 'Detail Post - Admin SMKN 4 BOGOR')
@section('page-title', 'Detail Post')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Post</h5>
                    <div>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $post->judul }}</h3>
                            <div class="mb-3">
                                <span class="badge bg-info me-2">{{ $post->kategori->judul }}</span>
                                <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                            <div class="content">
                                {!! nl2br(e($post->isi)) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Informasi Post</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Petugas:</strong> {{ $post->petugas->username }}</p>
                                    <p><strong>Dibuat:</strong> {{ $post->created_at->format('d M Y H:i') }}</p>
                                    <p><strong>Diupdate:</strong> {{ $post->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
