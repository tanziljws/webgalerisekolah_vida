@extends('layouts.app')

@section('title', 'Agenda - SMKN 4 BOGOR')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        padding: 4rem 0 3rem;
        margin-bottom: 3rem;
        color: white;
    }
    
    .agenda-card {
        transition: all 0.3s ease;
        border: none;
        height: 100%;
    }
    
    .agenda-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .agenda-date {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 1rem;
        border-radius: 10px;
        text-align: center;
        margin-right: 1rem;
        min-width: 80px;
    }
    
    .agenda-date .day {
        font-size: 2rem;
        font-weight: bold;
        line-height: 1;
    }
    
    .agenda-date .month {
        font-size: 0.9rem;
        text-transform: uppercase;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Agenda Sekolah</h1>
        <p class="lead mb-0">Kegiatan dan acara di SMKN 4 BOGOR</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse($posts as $post)
        <div class="col-md-6 col-lg-4">
            <div class="card agenda-card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="agenda-date">
                            <div class="day">{{ $post->created_at->format('d') }}</div>
                            <div class="month">{{ $post->created_at->format('M') }}</div>
                        </div>
                        <div>
                            <h5 class="card-title fw-bold mb-2">{{ $post->judul }}</h5>
                            <p class="text-muted small mb-0">
                                <i class="far fa-user me-1"></i>
                                {{ $post->petugas->username }}
                            </p>
                        </div>
                    </div>
                    
                    <p class="card-text text-muted">{{ Str::limit(strip_tags($post->isi), 100) }}</p>
                    
                    <a href="{{ route('guest.agenda.show', $post) }}" class="btn btn-outline-primary btn-sm">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada agenda tersedia</p>
        </div>
        @endforelse
    </div>
    
    @if($posts->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
