@extends('layouts.petugas')

@section('title', 'Detail Foto - Petugas SMKN 4 BOGOR')
@section('page-title', 'Detail Foto')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Foto</h5>
                    <a href="{{ route('petugas.foto.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if($foto->file && file_exists(public_path('images/gallery/' . $foto->file)))
                                <img src="{{ asset('images/gallery/' . $foto->file) }}" class="img-fluid rounded" alt="{{ $foto->judul }}">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                                    <i class="fas fa-image fa-5x text-white opacity-50"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Foto</h6>
                                    <hr>
                                    <p class="mb-2"><strong>Judul:</strong><br>
                                        {{ $foto->judul }}
                                    </p>
                                    <p class="mb-2"><strong>Galeri:</strong><br>
                                        {{ $foto->galery->post->judul ?? 'Tidak tersedia' }}
                                    </p>
                                    <p class="mb-2"><strong>File:</strong><br>
                                        <code>{{ $foto->file }}</code>
                                    </p>
                                    <p class="mb-0"><strong>Dibuat:</strong><br>
                                        {{ $foto->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('petugas.foto.edit', $foto) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-2"></i>Edit Foto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
