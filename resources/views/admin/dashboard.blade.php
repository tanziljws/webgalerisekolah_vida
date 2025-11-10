@extends('layouts.admin')

@section('title', 'Dashboard - Admin SMKN 4 BOGOR')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-newspaper fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Posts</h6>
                            <h3 class="mb-0">{{ $totalPosts }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-images fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Galeri</h6>
                            <h3 class="mb-0">{{ $totalGaleries }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-camera fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Foto</h6>
                            <h3 class="mb-0">{{ $totalFotos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Petugas</h6>
                            <h3 class="mb-0">{{ $totalPetugas }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Posts Terbaru</h5>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @forelse($recentPosts as $post)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-newspaper text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $post->judul }}</h6>
                            <small class="text-muted">
                                {{ $post->kategori->judul }} • {{ $post->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-muted text-center mb-0">Belum ada posts tersedia</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @forelse($recentActivities as $activity)
                        <div class="d-flex mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-circle text-primary" style="font-size: 8px;"></i>
                            </div>
                            <div>
                                <p class="mb-1 small">{{ $activity->description }}</p>
                                <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted text-center mb-0">Belum ada aktivitas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Buat Post
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.galery.create') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-images me-2"></i>Buat Galeri
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.foto.create') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-camera me-2"></i>Upload Foto
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.petugas.create') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-user-plus me-2"></i>Tambah Petugas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
