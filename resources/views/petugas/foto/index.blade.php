@extends('layouts.petugas')

@section('title', 'Foto - Petugas SMKN 4 BOGOR')
@section('page-title', 'Foto')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Foto</h5>
                <a href="{{ route('petugas.foto.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Upload Foto
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        @forelse($fotos as $foto)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100">
                @if($foto->file)
                    @php
                        // Check if file is stored using Storage (path contains 'fotos/') or public path
                        $imageUrl = str_contains($foto->file, 'fotos/') 
                            ? Storage::url($foto->file) 
                            : asset('images/gallery/' . $foto->file);
                    @endphp
                    <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $foto->judul ?? 'Foto' }}" style="height: 200px; object-fit: cover;" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'bg-secondary d-flex align-items-center justify-content-center\' style=\'height: 200px;\'><i class=\'fas fa-image fa-3x text-white opacity-50\'></i></div>';">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-3x text-white opacity-50"></i>
                    </div>
                @endif
                <div class="card-body p-3">
                    <h6 class="card-title mb-2">{{ Str::limit($foto->judul, 30) }}</h6>
                    <p class="card-text mb-2">
                        <small class="text-muted">
                            {{ optional(optional($foto->galery)->post)->judul ? Str::limit($foto->galery->post->judul, 25) : 'Galeri tidak tersedia' }}
                        </small>
                    </p>
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('petugas.foto.show', $foto) }}" class="btn btn-sm btn-info" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('petugas.foto.edit', $foto) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('petugas.foto.destroy', $foto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                    onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-images fa-4x text-muted opacity-50 mb-3"></i>
                    <p class="text-muted mb-0">Belum ada foto</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($fotos->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $fotos->links() }}
            </div>
        </div>
    </div>
    @endif
@endsection
