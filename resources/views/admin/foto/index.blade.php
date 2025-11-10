@extends('layouts.admin')

@section('title', 'Foto - Admin SMKN 4 BOGOR')
@section('page-title', 'Foto')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Foto</h5>
                    <a href="{{ route('admin.foto.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Upload Foto
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        @forelse($fotos as $foto)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ Storage::url($foto->file) }}" class="card-img-top" alt="Foto" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text mb-2">
                                        <small class="text-muted">
                                            Galeri: {{ optional(optional($foto->galery)->post)->judul ?? '-' }}
                                        </small>
                                    </p>
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('admin.foto.show', $foto) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.foto.edit', $foto) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.foto.destroy', $foto) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada foto</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $fotos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
